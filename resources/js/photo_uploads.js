// Loc: resources/js/photo_uploads.js
// usage: Regulate front-end file uploads (compression, batching, quota enforcement)

export default (config = {}) => ({
    uploading: false,
    progressText: "Proses...",
    maxPhotos: config.maxPhotos || 8,
    toast: { show: false, message: "" },

    get existingCount() {
        const existing = this.$wire.existingPhotos || [];
        return Array.isArray(existing)
            ? existing.length
            : Object.keys(existing).length;
    },

    get currentUploadedCount() {
        const uploaded = this.$wire.tempPhotos || [];
        return Array.isArray(uploaded)
            ? uploaded.length
            : Object.keys(uploaded).length;
    },

    showToastMessage(msg) {
        this.toast.message = msg;
        this.toast.show = true;
        setTimeout(() => {
            this.toast.show = false;
        }, 3500);
    },

    compressAndUpload(event) {
        let files = Array.from(event.target.files);
        if (!files.length) return;

        const currentTotal = this.existingCount + this.currentUploadedCount;
        const availableSlots = this.maxPhotos - currentTotal;

        // 1. Jika kuota sudah habis total
        if (availableSlots <= 0) {
            this.showToastMessage(
                `Batas maksimal ${this.maxPhotos} foto sudah tercapai.`,
            );
            event.target.value = "";
            return;
        }

        // 2. Jika file yang dipilih melebihi sisa kuota, POTONG array filenya
        if (files.length > availableSlots) {
            this.showToastMessage(
                `Maksimal ${this.maxPhotos} foto. Hanya ${availableSlots} foto pertama yang diproses.`,
            );
            files = files.slice(0, availableSlots); // 👈 Ambil secukupnya saja
        }

        this.uploading = true;
        this.progressText = `Kompres 0/${files.length}`;

        const dt = new DataTransfer();
        let processed = 0;

        const processFile = (file) => {
            return new Promise((resolve) => {
                if (file.size < 500 * 1024 || !file.type.startsWith("image/")) {
                    dt.items.add(file);
                    processed++;
                    this.updateProgress(processed, files.length);
                    resolve();
                    return;
                }

                const reader = new FileReader();
                reader.readAsDataURL(file);

                reader.onerror = () => {
                    dt.items.add(file);
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
                        const canvas = document.createElement("canvas");
                        const MAX_DIMENSION = 1920;
                        let width = img.width;
                        let height = img.height;

                        if (width > MAX_DIMENSION || height > MAX_DIMENSION) {
                            if (width > height) {
                                height = Math.round(
                                    (height * MAX_DIMENSION) / width,
                                );
                                width = MAX_DIMENSION;
                            } else {
                                width = Math.round(
                                    (width * MAX_DIMENSION) / height,
                                );
                                height = MAX_DIMENSION;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext("2d");
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = "high";
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob(
                            (blob) => {
                                if (blob) {
                                    const compressedFile = new File(
                                        [blob],
                                        file.name.replace(/\.[^/.]+$/, "") +
                                            ".jpg",
                                        {
                                            type: "image/jpeg",
                                            lastModified: Date.now(),
                                        },
                                    );
                                    dt.items.add(compressedFile);
                                } else {
                                    dt.items.add(file);
                                }
                                processed++;
                                this.updateProgress(processed, files.length);
                                resolve();
                            },
                            "image/jpeg",
                            0.82,
                        );
                    };
                };
            });
        };

        Promise.all(files.map((file) => processFile(file))).then(() => {
            this.startLivewireUpload(dt, event);
        });
    },

    updateProgress(processed, total) {
        this.progressText = `Kompres ${processed}/${total}`;
    },

    startLivewireUpload(dt, event) {
        this.progressText = `Mengunggah...`;

        this.$wire.uploadMultiple(
            "photos",
            dt.files,
            () => {
                this.uploading = false;
                event.target.value = "";
            },
            () => {
                this.uploading = false;
                event.target.value = "";
                this.showToastMessage("Gagal mengunggah foto.");
            },
            (e) => {
                this.progressText = `Upload ${e.detail.progress}%`;
            },
        );
    },
});
