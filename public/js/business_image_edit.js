document.addEventListener("DOMContentLoaded", function () {
    const mainImageInput = document.getElementById('business-main-image');
    const mainImageIcon = document.getElementById('business-main-image-icon');
    const deleteMainImageWrapper = document.getElementById('delete-business-main-image-wrapper');
    const deleteMainImageBtn = document.getElementById('delete-business-main-image');
    const previewImg = document.getElementById('main-image-preview');

    // ★ 最初の状態をセット！
    if (previewImg && previewImg.src) {
        // もし既にプレビューがある（main_image登録済み）なら
        if (mainImageIcon) {
            mainImageIcon.style.display = 'none';
        }
        if (deleteMainImageWrapper) {
            deleteMainImageWrapper.style.display = 'block';
        }
    } else {
        // 画像ないなら、アイコンだけ表示＆削除ボタンは隠す
        if (mainImageIcon) {
            mainImageIcon.style.display = 'block';
        }
        if (deleteMainImageWrapper) {
            deleteMainImageWrapper.style.display = 'none';
        }
    }

    if (mainImageInput) {
        mainImageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                let previewImg = document.getElementById('main-image-preview');
                if (!previewImg) {
                    previewImg = document.createElement('img');
                    previewImg.id = 'main-image-preview';
                    previewImg.className = 'img-lg img-thumbnail mb-2 d-block';
                    previewImg.style.maxHeight = '200px';
                    mainImageIcon.parentNode.insertBefore(previewImg, mainImageIcon);
                }
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';

                if (mainImageIcon) {
                    mainImageIcon.style.display = 'none';
                }
                if (deleteMainImageWrapper) {
                    deleteMainImageWrapper.style.display = 'block';
                }
            };
            reader.readAsDataURL(file);
        });
    }

    if (deleteMainImageBtn) {
        deleteMainImageBtn.addEventListener('click', function() {
            const previewImg = document.getElementById('main-image-preview');
            const mainImageIcon = document.getElementById('business-main-image-icon');
        
            // プレビュー画像を非表示＆src空に
            if (previewImg) {
                previewImg.src = '';
                previewImg.style.display = 'none';
            }
        
            // fa-imageアイコンを表示する
            if (mainImageIcon) {
                mainImageIcon.style.display = 'block';
            }
        
            // ファイルinputをクリアする
            if (mainImageInput) {
                mainImageInput.value = '';
            }
        
            // 削除ボタンも非表示にする
            if (deleteMainImageWrapper) {
                deleteMainImageWrapper.style.display = 'none';
            }
        });
        
        
    }
});


    // ヘッダー画像の削除
    // deletebusinessMainImageBtn.addEventListener('click', function () {
        // if (!confirm('メイン画像を削除しますか？')) return;
    
        // fetch("http://127.0.0.1:8000/business/mainimage", {
        //     method: "DELETE",
        //     headers: {
        //         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        //         "Accept": "application/json"
        //     }
        // })
        // .then(response => {
        //     if (response.ok) {
        //         businessMainImagePreview.src = '';
        //         businessMainImagePreview.style.display = 'none';
        //         if (businessMainImageIcon) businessMainImageIcon.style.display = 'block';
        //         document.getElementById("business-main-image-preview").classList.add("d-none");
        //         document.getElementById("business-main-image-icon").classList.remove("d-none");
        //     } else {
        //         alert('ヘッダー画像の削除に失敗しました');
        //     }
            // if (response.ok) {
            //     // プレビュー画像をリセット
            //     businessMainImagePreview.src = '';
            //     businessMainImagePreview.classList.add('d-none');
    
            //     // アイコンを再表示
            //     businessMainImageIcon.classList.remove('d-none');
    
            //     // ファイルinputもリセット（必要なら）
            //     businessMainImageInput.value = '';
            // } else {
            //     alert('メイン画像の削除に失敗しました');
            // }
        // })
        // .catch(() => {
        //     // alert('通信エラーが発生しました');
        // });


document.addEventListener("DOMContentLoaded", function () {
    const photoInputs = document.querySelectorAll('.photo-input');

    function attachDeleteEvent(deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const index = deleteBtn.getAttribute('data-preview-index');
            const previewImg = document.getElementById('preview_img_' + index);
            const placeholder = document.getElementById('placeholder_' + index);
            const input = document.getElementById('photo_' + index);

            if (previewImg) {
                previewImg.remove();
            }
            deleteBtn.remove();

            if (placeholder) {
                placeholder.style.display = 'block';
            }
            if (input) {
                input.value = '';
            }
        });
    };
    });
    

    document.addEventListener("DOMContentLoaded", function () {
        const photoInputs = document.querySelectorAll('.photo-input');
    
        function attachDeleteEvent(button) {
            button.addEventListener('click', function() {
                const index = button.getAttribute('data-preview-index');
    
                // 対応するhiddenの値を1にする
                const deleteHidden = document.getElementById('delete_photo_' + index);
                if (deleteHidden) {
                    deleteHidden.value = '1';
                    console.log('hiddenの値を1にセットしました: delete_photo_' + index);
                }
    
                // プレビュー画像を消す
                const previewImg = document.getElementById('preview_img_' + index);
                if (previewImg) {
                    previewImg.remove();
                }
    
                // placeholderを表示
                const placeholder = document.getElementById('placeholder_' + index);
                if (placeholder) {
                    placeholder.style.display = 'block';
                }
    
                // ファイルinputもクリア
                const fileInput = document.getElementById('photo_' + index);
                if (fileInput) {
                    fileInput.value = '';
                }
    
                // この削除ボタン自体も消す
                button.remove();
            });
        }
    
        // 最初からある削除ボタンにもattachする
        document.querySelectorAll('.delete-photo-btn').forEach(function(button) {
            attachDeleteEvent(button);
        });
    
        // ファイル選択時のプレビュー処理
        photoInputs.forEach(function(input) {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;
    
                const reader = new FileReader();
                reader.onload = function(e) {
                    const index = input.id.split('_')[1];
                    const previewWrapper = document.getElementById('preview_' + index);
    
                    let previewImg = document.getElementById('preview_img_' + index);
    
                    if (!previewImg) {
                        previewImg = document.createElement('img');
                        previewImg.id = 'preview_img_' + index;
                        previewImg.className = 'img-lg img-thumbnail mb-2 d-block';
                        previewImg.style.maxHeight = '150px';
                        previewWrapper.prepend(previewImg);
                    }
    
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
    
                    const placeholder = document.getElementById('placeholder_' + index);
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
    
                    if (!document.querySelector(`.delete-photo-btn[data-preview-index="${index}"]`)) {
                        const deleteBtn = document.createElement('button');
                        deleteBtn.type = 'button';
                        deleteBtn.className = 'btn btn-red delete-photo-btn py-2 px-3';
                        deleteBtn.setAttribute('data-preview-index', index);
    
                        const icon = document.createElement('i');
                        icon.className = 'fa-solid fa-trash-can fa-lg';
                        deleteBtn.appendChild(icon);
    
                        previewWrapper.appendChild(deleteBtn);
    
                        // ★ここで新しい削除ボタンにもイベント付与
                        attachDeleteEvent(deleteBtn);
                    }
                };
                reader.readAsDataURL(file);
            });
        });
    });
    

    // // 既存の削除ボタンにもイベントを付与
    // document.addEventListener("DOMContentLoaded", function () {
    //     const photoInputs = document.querySelectorAll('.photo-input');
    
    //     // function attachDeleteEvent(button) {
    //     //     button.addEventListener('click', function() {
    //     //         const index = button.getAttribute('data-preview-index');
    //     //         console.log('押したボタンのindex:', index);
        
    //     //         const deleteHidden = document.getElementById('delete_photo_' + index);
    //     //         console.log('対応するhidden要素:', deleteHidden);
        
    //     //         if (deleteHidden) {
    //     //             deleteHidden.value = '1';
    //     //             console.log('delete_hiddenのvalueを1にセットしました');
    //     //         } else {
    //     //             console.log('delete_photo_' + index + ' が見つかりません！');
    //     //         }
        
    //     //         const previewImg = document.getElementById('preview_img_' + index);
    //     //         if (previewImg) {
    //     //             previewImg.remove();
    //     //         }
        
    //     //         const placeholder = document.getElementById('placeholder_' + index);
    //     //         if (placeholder) {
    //     //             placeholder.style.display = 'block';
    //     //         }
        
    //     //         const fileInput = document.getElementById('photo_' + index);
    //     //         if (fileInput) {
    //     //             fileInput.value = '';
    //     //         }
        
    //     //         button.remove();
    //     //     });
    //     // }
    //     function attachDeleteEvent(button) {
    //         button.addEventListener('click', function() {
    //             alert('削除ボタン押されました！');
    //         });
    //     }
    
    //     document.querySelectorAll('.delete-photo-btn').forEach(function(button) {
    //         attachDeleteEvent(button);
    //     });
    
    //     // ファイル選択時の処理
    //     photoInputs.forEach(function(input) {
    //         input.addEventListener('change', function(event) {
    //             const file = event.target.files[0];
    //             if (!file) return;
    
    //             const reader = new FileReader();
    //             reader.onload = function(e) {
    //                 const index = input.id.split('_')[1];
    //                 const previewWrapper = document.getElementById('preview_' + index);
    
    //                 let previewImg = document.getElementById('preview_img_' + index);
    
    //                 if (!previewImg) {
    //                     // imgがなければ新しく作る
    //                     previewImg = document.createElement('img');
    //                     previewImg.id = 'preview_img_' + index;
    //                     previewImg.className = 'img-lg img-thumbnail mb-2 d-block mx-auto';
    //                     previewImg.style.maxHeight = '150px';
    //                     previewWrapper.prepend(previewImg);
    //                 }
    
    //                 previewImg.src = e.target.result;
    //                 previewImg.style.display = 'block';
    
    //                 const placeholder = document.getElementById('placeholder_' + index);
    //                 if (placeholder) {
    //                     placeholder.style.display = 'none';
    //                 }
    
    //                 // 削除ボタンがなければ新しく作る
    //                 if (!document.querySelector(`.delete-photo-btn[data-preview-index="${index}"]`)) {
    //                     const deleteBtn = document.createElement('button');
    //                     deleteBtn.type = 'button';
    //                     deleteBtn.className = 'btn btn-red delete-photo-btn position-absolute top-0 end-0 m-2';
    //                     deleteBtn.setAttribute('data-preview-index', index);

    //                     const icon = document.createElement('i');
    //                     icon.className = 'fa-solid fa-trash-can';
    //                     deleteBtn.appendChild(icon);

    //                     previewWrapper.appendChild(deleteBtn);

    //                     // ★ここが超重要！！
    //                     // 新しく作ったボタンに、ちゃんとイベントをつける
    //                     attachDeleteEvent(deleteBtn);
    //                 }
    //             };
    //             reader.readAsDataURL(file);
    //         });
    //     });
    // });
    
