document.getElementById('goTopButton').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' //スムーズなスクロール
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // モーダル表示時にリロード
    document.querySelectorAll('[id^="likes-modal-"]').forEach(modal => {
        modal.addEventListener('show.bs.modal', function () {
            const questId = this.id.replace('likes-modal-', '');
            refreshQuestLikesModal(questId);
        });
    });

    // Like トグル
    document.querySelectorAll('.btn-like-toggle').forEach(button => {
        button.addEventListener('click', async function () {
            const questId = this.dataset.questId;
            const liked = this.dataset.liked === '1';

            const url = `/quest/${questId}/toggle-like`;
            const method = 'POST'; // Spotと同じく POST でトグル


            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    }
                });

                const data = await res.json();

                const icon = this.querySelector('.like-icon');
                const countElem = this.closest('.d-flex').querySelector('.like-count');

                if (liked) {
                    icon.classList.remove('fas', 'text-danger');
                    icon.classList.add('far');
                    this.dataset.liked = '0';
                    if (countElem) countElem.textContent = parseInt(countElem.textContent) - 1;
                } else {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-danger');
                    this.dataset.liked = '1';
                    if (countElem) countElem.textContent = parseInt(countElem.textContent) + 1;
                }

                refreshQuestLikesModal(questId);

            } catch (err) {
                console.error('❌ Like toggle failed:', err);
            }
        });
    });

    bindFollowButtons();
    refreshQuestBody();
});

// モーダル中身更新
async function refreshQuestLikesModal(questId) {
    try {
        const res = await fetch(`/quest/${questId}/likes/html`);
        if (!res.ok) throw new Error('モーダルの取得に失敗');

        const html = await res.text();
        const oldModal = document.getElementById(`likes-modal-${questId}`);

        if (oldModal) {
            oldModal.outerHTML = html;
            const newModal = document.getElementById(`likes-modal-${questId}`);
            if (newModal) {
                newModal.addEventListener('show.bs.modal', function () {
                    refreshQuestLikesModal(questId);
                });
            }
        }

        bindFollowButtons();
    } catch (error) {
        console.error("🚨 モーダルHTML更新失敗:", error);
    }
}

// フォロー切替
function bindFollowButtons() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.follow-toggle-form button').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const parent = button.closest('.follow-toggle-form');
            const userId = parent.dataset.userId;

            const isCurrentlyFollowing = button.classList.contains('btn-following');
            const url = isCurrentlyFollowing
                ? `/follow/${userId}/delete`
                : `/follow/${userId}/store`;
            const method = isCurrentlyFollowing ? 'DELETE' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    }
                });

                const result = await res.json();

                if (result.message === 'Followed') {
                    button.classList.remove('btn-follow');
                    button.classList.add('btn-following');
                    button.textContent = 'Following';
                } else if (result.message === 'Unfollowed') {
                    button.classList.remove('btn-following');
                    button.classList.add('btn-follow');
                    button.textContent = 'Follow';
                }

            } catch (error) {
                console.error("❌ follow toggle failed:", error);
            }
        });
    });
}
async function refreshQuestBody() {
    const questId = getQuestIdFromURL();
    const response = await fetch(`/questbody/getAllQuestBodies/${questId}`);
    
    if (response.ok) {
        const questBodiesHTML = await response.text();
        document.getElementById("quest-body-container").innerHTML = questBodiesHTML;

        const images = document.querySelectorAll("#quest-body-container img");

        if (images.length > 0) {
            let loadedCount = 0;

            images.forEach(img => {
                img.onload = () => {
                    loadedCount++;
                    if (loadedCount === images.length) {
                        console.log("✅ すべての画像読み込み完了！");
                        adjustDescriptionHeight(); // ✅ 高さ調整
                    }
                };
            });

            // 🔥万が一 onload が走らなかったときの保険
            setTimeout(() => {
                console.warn("⏰ onload 全部待たずに強制実行！");
                adjustDescriptionHeight();
            }, 1000);
        } else {
            console.log("⚠️ 表示すべき画像なし");
            adjustDescriptionHeight();
        }
    }
}


// function getQuestIdFromURL() {
//     const path = window.location.pathname;
//     const pathParts = path.split('/');
//     return pathParts[pathParts.length - 1];
// }

//======================================================ADJUST HEIGHT
function adjustDescriptionHeight() {
    console.log("🎯 adjustDescriptionHeight: 実行開始！");

    let spotEntries = document.querySelectorAll(".spot-entry"); // 各スポットを取得

    if (spotEntries.length === 0) {
        console.warn("⚠️ adjustDescriptionHeight: スポットが見つかりません");
        return;
    }

    spotEntries.forEach((spot, index) => {
        let imageContainer = spot.querySelector(".image-container");
        let description = spot.querySelector(".spot-description");

        if (!imageContainer || !description) {
            console.warn(`⚠️ Spot ${index + 1}: 画像コンテナまたは説明が見つかりません`);
            return;
        }

        // 画像の高さが確定するまで待つ（非同期に調整）
        let totalImageHeight = 0;
        let images = imageContainer.querySelectorAll("img");

        if (images.length === 0) {
            console.warn(`⚠️ Spot ${index + 1}: 画像がありません`);
            return;
        }

        images.forEach(image => {
            image.onload = () => {
                totalImageHeight += image.clientHeight;
                console.log(`📷 画像の高さ: ${image.clientHeight}px, 合計: ${totalImageHeight}px`);
                applyHeightAdjustment(description, totalImageHeight);
            };
        });

        // すでに読み込まれている画像の高さも考慮
        setTimeout(() => {
            images.forEach(image => {
                totalImageHeight += image.clientHeight;
            });
            console.log(`📏 [Spot ${index + 1}] 画像の合計高さ: ${totalImageHeight}px, 説明の高さ: ${description.scrollHeight}px`);
            applyHeightAdjustment(description, totalImageHeight);
        }, 500);
    });

    

    
}

// 🔥 高さ調整の適用ロジックを関数化
function applyHeightAdjustment(description, totalImageHeight) {
    if (!description) return;

    let descriptionHeight = description.scrollHeight;

    if (descriptionHeight > totalImageHeight) {
        console.log("🟢 説明文が長いので高さ制限を適用");
        description.style.maxHeight = totalImageHeight + "px";
        description.style.overflowY = "auto";
    } else {
        console.log("🔵 説明文が短いので制限なし");
        description.style.maxHeight = "none";
        description.style.overflowY = "hidden";
    }
}

// 🔥 ページの読み込み時とリサイズ時に実行
// window.addEventListener("load", adjustDescriptionHeight);
window.addEventListener("resize", adjustDescriptionHeight);




//=====================================================Modal================================

    window.addEventListener("load", adjustDescriptionHeight);
    window.addEventListener("resize", adjustDescriptionHeight);
//=================================================AGENDA
    document.querySelectorAll('.agenda-toggle').forEach(toggle => {
        toggle.addEventListener('change', async function () {
            const questbodyId = this.dataset.id;
            const isAgenda = this.checked ? 1 : 0;
    
            try {
                const response = await fetch(`/questbody/agenda/${questbodyId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ is_agenda: isAgenda })
                });
    
                const result = await response.json();
                if (response.ok) {
                    console.log(`🟢 Agenda status updated for ID ${questbodyId}:`, result.is_agenda);
                } else {
                    console.warn(`⚠️ 更新失敗:`, result);
                    alert("Agendaの更新に失敗しました");
                }
            } catch (error) {
                console.error("❌ 通信エラー:", error);
                alert("通信エラーが発生しました");
            }
        });
    });
    



