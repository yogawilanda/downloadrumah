import photoUploader from './photo_uploads';
import kprApp from './kpr_app';
import botNavBar from './bot_nav_bar';

document.addEventListener('alpine:init', () => {
    Alpine.data('photoUploader', photoUploader);
    Alpine.data('kprApp', kprApp);
    Alpine.data('botNavBar', botNavBar);
});
