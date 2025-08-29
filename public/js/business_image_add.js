document.addEventListener("DOMContentLoaded", function () {
    const mainImageInput = document.getElementById('business-main-image');
    const mainImageIcon = document.getElementById('business-main-image-icon');
    const deleteMainImageWrapper = document.getElementById('delete-business-main-image-wrapper');
    const deleteMainImageBtn = document.getElementById('delete-business-main-image');

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

                // アイコンは非表示
                if (mainImageIcon) {
                    mainImageIcon.style.display = 'none';
                }

                // 削除ボタンは表示する
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
            if (previewImg) {
                previewImg.remove();
            }
            if (mainImageIcon) {
                mainImageIcon.style.display = 'block';
            }
            if (mainImageInput) {
                mainImageInput.value = '';
            }
            // 削除ボタンをまた非表示に戻す
            if (deleteMainImageWrapper) {
                deleteMainImageWrapper.style.display = 'none';
            }
        });
    }
});




document.addEventListener("DOMContentLoaded", function () {
    const photoInputs = document.querySelectorAll('.photo-input');

    function attachDeleteEvent(button) {
        button.addEventListener('click', function() {
            const index = button.getAttribute('data-preview-index');

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

            // この削除ボタンも消す
            button.remove();
        });
    }

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

                    attachDeleteEvent(deleteBtn);
                }
            };
            reader.readAsDataURL(file);
        });
    });
});
