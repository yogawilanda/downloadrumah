// Loc: resources\js\photo_uploads.js
// usage: Regulate front-end file uploads (compression, batching, quota enforcement)

export default (config = {}) => ({
    uploading: false,
    progressText: 'Proses...',
    maxPhotos: config.maxPhotos || 8,

    get existingCount() {
        const existing = this.$wire.existingPhotos || [];
        return Array.isArray(existing) ? existing.length : Object.keys(existing).length;
    },

    get currentUploadedCount() {
        const uploaded = this.$wire.photos || [];
        return Array.isArray(uploaded) ? uploaded.length : Object.keys(uploaded).length;
    },

    compressAndUpload(event) {
        const files = Array.from(event.target.files);
        if (!files.length) return;

        const currentTotal = this.existingCount + this.currentUploadedCount;
        const totalPhotos = currentTotal + files.length;

        if (totalPhotos > this.maxPhotos) {
            const sisaKuota = this.maxPhotos - currentTotal;
            if (sisaKuota <= 0) {
                alert(`Batas maksimal ${this.maxPhotos} foto sudah tercapai.`);
            } else {
                alert(`Kamu hanya bisa menambah ${sisaKuota} foto lagi (Maksimal ${this.maxPhotos} foto).`);
            }
            event.target.value = '';
            return;
        }

        this.uploading = true;
        this.progressText = `Kompres 0/${files.length}`;

        const dt = new DataTransfer();
        let processed = 0;

        // BUG FIX #1: Gunakan Promise.all untuk menangani async FileReader secara akurat
        const processFile = (file) => {
            return new Promise((resolve) => {
                // Skip jika ukuran < 500KB atau BUKAN file gambar (PDF/dokumen aman dari canvas crash)
                if (file.size < 500 * 1024 || !file.type.startsWith('image/')) {
                    dt.items.add(file);
                    processed++;
                    this.updateProgress(processed, files.length);
                    resolve();
                    return;
                }

                const reader = new FileReader();
                reader.readAsDataURL(file);

                // BUG FIX #2: Event onError untuk cegah freeze jika file korup
                reader.onerror = () => {
                    dt.items.add(file); // Fallback ke file asli jika reader gagal
                    processed++;
                    this.updateProgress(processed, files.length);
                    resolve();
                };

                reader.onload = (e) => {
                    const img = new Image();
                    img.src = e.target.result;

                    img.onerror = () => {
                        dt.items.add(file);
                        processed++;
                        this.updateProgress(processed, files.length);
                        resolve();
                    };

                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        const MAX_DIMENSION = 1920;
                        let width = img.width;
                        let height = img.height;

                        if (width > MAX_DIMENSION || height > MAX_DIMENSION) {
                            if (width > height) {
                                height = Math.round((height * MAX_DIMENSION) / width);
                                width = MAX_DIMENSION;
                            } else {
                                width = Math.round((width * MAX_DIMENSION) / height);
                                height = MAX_DIMENSION;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob((blob) => {
                            if (blob) {
                                const compressedFile = new File([blob], file.name.replace(/\.[^/.]+$/, '') + '.jpg', {
                                    type: 'image/jpeg',
                                    lastModified: Date.now(),
                                });
                                dt.items.add(compressedFile);
                            } else {
                                dt.items.add(file); // Fallback ke file asli jika blob null
                            }
                            processed++;
                            this.updateProgress(processed, files.length);
                            resolve();
                        }, 'image/jpeg', 0.82);
                    };
                };
            });
        };

        // Jalankan semua async prosessing, baru trigger uploadLivewire sekali jalan
        Promise.all(files.map(file => processFile(file))).then(() => {
            this.startLivewireUpload(dt, event);
        });
    },

    updateProgress(processed, total) {
        this.progressText = `Kompres ${processed}/${total}`;
    },

    startLivewireUpload(dt, event) {
        this.progressText = `Mengunggah...`;

        this.$wire.uploadMultiple('photos', dt.files,
            () => {
                this.uploading = false;
                event.target.value = ''; // BUG FIX #3: Reset input file setelah upload selesai
            },
            () => {
                this.uploading = false;
                event.target.value = '';
                alert('Gagal mengunggah foto.');
            },
            (e) => {
                this.progressText = `Upload ${e.detail.progress}%`;
            }
        );
    }
});
