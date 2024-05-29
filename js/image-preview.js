class ImagePreview {
    constructor() {
        this.imageInput = document.getElementById('image-input');
        this.selectImageButton = document.getElementById('trigger-image-input');
        this.imageDisplay = document.getElementById('image-display');
        this.addEventListenerToTriggerButton();
        this.addEventListenerToPreviewImage();
    }

    addEventListenerToTriggerButton() {
        this.selectImageButton.addEventListener('click', () => this.imageInput.click());
    }

    addEventListenerToPreviewImage() {
        this.imageInput.addEventListener('change', (event) => this.preview(event));
    }

    preview(event) {
        const files = event.target.files;

        if (files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = (e) => {
                this.imageDisplay.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    }
}

const imagePreview = new ImagePreview();
