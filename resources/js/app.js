import photoUploader from './photo_uploads';

document.addEventListener('alpine:init', () => {
    Alpine.data('photoUploader', photoUploader);
});
