import photoUploader from './photo_uploads';
import kprApp from './kpr_app';

document.addEventListener('alpine:init', () => {
    Alpine.data('photoUploader', photoUploader);
    Alpine.data('kprApp', kprApp);
});
