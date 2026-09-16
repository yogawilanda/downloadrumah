<div x-data="{
    words: ['rumah', 'kos', 'tanah', 'ruko'],
    word: 0,
    length: 1,
    timer: null,

    init() {
        this.timer = setTimeout(() => this.next(), 500);
    },

    next() {
        const current = this.words[this.word];

        if (this.length < current.length) {
            this.length++;

            this.timer = setTimeout(() => {
                this.next();
            }, 200);

            return;
        }

        this.timer = setTimeout(() => {
            this.word = (this.word + 1) % this.words.length;
            this.length = 1;
            this.next();
        }, 3000);
    },

    get visibleWord() {
        return this.words[this.word].substring(0, this.length);
    },

    destroy() {
        clearTimeout(this.timer);
    }
}" class="mx-auto max-w-5xl">

    {{-- Brand --}}
    <div
        class="mb-5 flex items-center gap-2 text-[10px] font-bold
               uppercase tracking-[0.2em] text-sky-600 dark:text-sky-400"
    >
        <span class="h-1.5 w-1.5 bg-sky-500"></span>

        DownloadRumah
    </div>

    {{-- Hero title --}}
    <h1
        class="max-w-4xl text-[2.5rem] font-black leading-[1.01]
               tracking-[-0.05em] text-slate-950
               dark:text-slate-100
               sm:text-5xl lg:text-[3.5rem]"
    >
        <span class="inline-flex flex-wrap items-baseline">
            <span>Cari</span>

            <span
                class="word-reveal mx-1.5 text-sky-600 dark:text-sky-400"
                x-text="visibleWord"
            ></span>

            <span>yang kamu butuhkan.</span>
        </span>

        <br class="hidden sm:block">

        {{-- Dynamic intent --}}
        <span>
            <span class="text-sky-600 dark:text-sky-400">Cari</span>
            <span class="text-slate-950 dark:text-slate-100">
                {{ $intent === 'search'
                    ? ' yang cocok.'
                    : ' yang mencari.' }}
            </span>
        </span>
    </h1>

    {{-- Supporting text --}}
    <p
        class="mt-6 max-w-2xl text-base font-medium leading-7
               text-slate-600 dark:text-slate-400
               lg:text-lg"
    >
        Mulai dari kebutuhanmu.
    </p>
</div>
