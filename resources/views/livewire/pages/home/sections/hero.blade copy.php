<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $intent = 'search';

    public int $step = 1;

    public ?string $propertyType = null;

    // CHANGED
    public ?string $searchState = null;

    public string $location = '';

    public string $budget = '';

    public ?string $purpose = null;


    public function setIntent(string $intent): void
    {
        if (!in_array($intent, ['search', 'offer'])) {
            return;
        }

        $this->intent = $intent;
        $this->step = 1;

        // CHANGED
        $this->reset([
            'propertyType',
            'searchState',
            'location',
            'budget',
            'purpose',
        ]);
    }


    // CHANGED
    public function selectSearchState(string $state): void
    {
        $this->searchState = $state;

        if ($state === 'known') {
            $this->step = 2;
            return;
        }

        // User belum tahu jenis properti.
        // Langsung lanjut memahami lokasi.
        $this->step = 3;
    }


    public function selectPropertyType(string $type): void
    {
        $this->propertyType = $type;

        // CHANGED
        $this->step = 3;
    }


    public function continueToBudget(): void
    {
        if (!$this->location) {
            return;
        }

        // CHANGED
        $this->step = 4;
    }


    public function continueToPurpose(): void
    {
        if (!$this->budget) {
            return;
        }

        // CHANGED
        $this->step = 5;
    }


    public function selectPurpose(string $purpose): void
    {
        $this->purpose = $purpose;

        // CHANGED
        $this->step = 6;
    }


    public function back(): void
    {
        if ($this->step <= 1) {
            return;
        }

        // CHANGED
        // Kalau user tidak memilih jenis properti,
        // step 3 kembali ke diagnosis, bukan step 2.
        if ($this->step === 3 && $this->searchState !== 'known') {
            $this->step = 1;
            return;
        }

        $this->step--;
    }


    public function resetMatching(): void
    {
        $this->step = 1;

        // CHANGED
        $this->reset([
            'propertyType',
            'searchState',
            'location',
            'budget',
            'purpose',
        ]);
    }
};
?>

<x-layouts.structural-section framed class="border-b border-slate-300 bg-slate-200/20">

    <div class="bg-slate-100 px-5 py-14 sm:px-8 md:px-12 md:py-20 lg:px-14">

        {{-- ============================================================
        HERO
        ============================================================= --}}

        @include('livewire.pages.home.sections.hero-title')


        {{-- ============================================================
        MATCHING SURFACE
        ============================================================= --}}

        <div class="mx-auto mt-12 max-w-5xl">

            {{-- Label --}}

            <div class="mb-4 flex items-center gap-2">
                <span class="h-1.5 w-1.5 bg-sky-500"></span>

                <span
                    class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-500"
                >
                    Mulai dari sini
                </span>
            </div>


            {{-- ========================================================
            TABS
            ========================================================= --}}

            <div class="grid grid-cols-2 border border-slate-300">

                <button
                    type="button"
                    wire:click="setIntent('search')"
                    @class([
                        'relative px-5 py-5 text-left transition-all duration-150 sm:px-7 sm:py-6',
                        'bg-white text-slate-950' => $intent === 'search',
                        'bg-slate-200/60 text-slate-500 hover:bg-slate-200'
                            => $intent !== 'search',
                    ])
                >

                    <span
                        class="block text-[10px] font-black uppercase tracking-[0.16em]"
                        @class([
                            'text-sky-600' => $intent === 'search',
                            'text-slate-400' => $intent !== 'search',
                        ])
                    >
                        Saya mencari
                    </span>

                    <span class="mt-1 block text-base font-black sm:text-lg">
                        Properti
                    </span>

                    @if ($intent === 'search')
                        <span class="absolute inset-x-0 bottom-0 h-1 bg-sky-500"></span>
                    @endif

                </button>


                <button
                    type="button"
                    wire:click="setIntent('offer')"
                    @class([
                        'relative border-l border-slate-300 px-5 py-5 text-left transition-all duration-150 sm:px-7 sm:py-6',
                        'bg-white text-slate-950' => $intent === 'offer',
                        'bg-slate-200/60 text-slate-500 hover:bg-slate-200'
                            => $intent !== 'offer',
                    ])
                >

                    <span
                        class="block text-[10px] font-black uppercase tracking-[0.16em]"
                        @class([
                            'text-sky-600' => $intent === 'offer',
                            'text-slate-400' => $intent !== 'offer',
                        ])
                    >
                        Saya punya
                    </span>

                    <span class="mt-1 block text-base font-black sm:text-lg">
                        Properti
                    </span>

                    @if ($intent === 'offer')
                        <span class="absolute inset-x-0 bottom-0 h-1 bg-sky-500"></span>
                    @endif

                </button>

            </div>


            {{-- ========================================================
            PROMPT AREA
            ========================================================= --}}

            <div class="border-x border-b border-slate-300 bg-white">


                {{-- ====================================================
                STEP 1 — INITIAL INTENT
                ===================================================== --}}

                @if ($step === 1)

                    <div class="p-6 sm:p-8 md:p-10">

                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em] text-sky-600"
                            >
                                DownloadRumah
                            </span>

                            <h2
                                class="mt-2 text-xl font-black tracking-[-0.025em]
                                       text-slate-950 sm:text-2xl"
                            >
                                {{ $intent === 'search'
                                    ? 'Apa yang sedang kamu butuhkan?'
                                    : 'Apa yang ingin kamu tawarkan?' }}
                            </h2>

                        </div>


                        {{-- CHANGED: initial diagnosis --}}

                        @if ($intent === 'search')

                            <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">

                                @foreach ([
                                    'known' => 'Saya sudah tahu yang saya cari',
                                    'browsing' => 'Saya masih lihat-lihat',
                                    'undecided' => 'Saya belum yakin',
                                    'comparing' => 'Saya sedang membandingkan',
                                    'starting' => 'Saya baru mulai mencari',
                                ] as $value => $label)

                                    <button
                                        type="button"
                                        wire:click="selectSearchState('{{ $value }}')"
                                        class="border border-slate-300 bg-slate-50
                                               px-4 py-4 text-left text-sm font-bold
                                               text-slate-700 transition
                                               hover:border-slate-950 hover:bg-white"
                                    >
                                        {{ $label }}

                                        <span class="float-right text-slate-400">
                                            →
                                        </span>
                                    </button>

                                @endforeach

                            </div>

                        @else

                            {{-- CHANGED: offer flow tetap sederhana --}}

                            <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                                @foreach ([
                                    'house' => 'Rumah',
                                    'kos' => 'Kos',
                                    'land' => 'Tanah',
                                    'shop' => 'Ruko',
                                ] as $value => $label)

                                    <button
                                        type="button"
                                        wire:click="selectPropertyType('{{ $value }}')"
                                        class="border border-slate-300 bg-slate-50
                                               px-4 py-5 text-left transition-all
                                               hover:border-slate-950 hover:bg-white"
                                    >
                                        <span class="block text-sm font-black text-slate-950">
                                            {{ $label }}
                                        </span>

                                        <span class="mt-1 block text-xs text-slate-400">
                                            Pilih →
                                        </span>
                                    </button>

                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- ====================================================
                    STEP 2 — PROPERTY TYPE
                    ===================================================== --}}

                @elseif ($step === 2)

                    <div class="p-6 sm:p-8 md:p-10">

                        <button
                            type="button"
                            wire:click="back"
                            class="mb-6 text-xs font-bold text-slate-400
                                   hover:text-slate-950"
                        >
                            ← Kembali
                        </button>


                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em]
                                       text-slate-400"
                            >
                                DownloadRumah
                            </span>

                            <h2
                                class="mt-2 text-xl font-black tracking-[-0.025em]
                                       text-slate-950 sm:text-2xl"
                            >
                                Oke. Kamu sedang mencari apa?
                            </h2>

                        </div>


                        <div class="mt-8 grid grid-cols-2 gap-2 sm:grid-cols-4">

                            @foreach ([
                                'house' => 'Rumah',
                                'kos' => 'Kos',
                                'land' => 'Tanah',
                                'shop' => 'Ruko',
                            ] as $value => $label)

                                <button
                                    type="button"
                                    wire:click="selectPropertyType('{{ $value }}')"
                                    class="border border-slate-300 bg-slate-50
                                           px-4 py-5 text-left transition-all
                                           hover:border-slate-950 hover:bg-white"
                                >
                                    <span class="block text-sm font-black text-slate-950">
                                        {{ $label }}
                                    </span>

                                    <span class="mt-1 block text-xs text-slate-400">
                                        Pilih →
                                    </span>
                                </button>

                            @endforeach

                        </div>

                    </div>


                    {{-- ====================================================
                    STEP 3 — LOCATION
                    ===================================================== --}}

                @elseif ($step === 3)

                    <div class="p-6 sm:p-8 md:p-10">

                        <button
                            type="button"
                            wire:click="back"
                            class="mb-6 text-xs font-bold text-slate-400
                                   hover:text-slate-950"
                        >
                            ← Kembali
                        </button>


                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em]
                                       text-slate-400"
                            >
                                DownloadRumah
                            </span>

                            <h2
                                class="mt-2 text-xl font-black tracking-[-0.025em]
                                       text-slate-950 sm:text-2xl"
                            >
                                {{ $intent === 'search'
                                    ? 'Di mana kamu mencarinya?'
                                    : 'Di mana properti ini berada?' }}
                            </h2>

                        </div>


                        <div class="mt-8 max-w-xl">

                            <label class="mb-2 block text-xs font-bold text-slate-600">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                wire:model="location"
                                wire:keydown.enter="continueToBudget"
                                placeholder="Contoh: Surabaya, Sidoarjo, Malang..."
                                class="w-full border border-slate-300 bg-slate-50
                                       px-4 py-4 text-sm font-medium text-slate-950
                                       outline-none transition
                                       focus:border-slate-950 focus:bg-white"
                            >

                        </div>


                        <div class="mt-6 flex justify-end">

                            <button
                                type="button"
                                wire:click="continueToBudget"
                                class="bg-slate-950 px-5 py-3.5 text-xs font-bold
                                       text-white transition hover:bg-slate-800"
                            >
                                Lanjut →
                            </button>

                        </div>

                    </div>


                    {{-- ====================================================
                    STEP 4 — BUDGET / PRICE
                    ===================================================== --}}

                @elseif ($step === 4)

                    <div class="p-6 sm:p-8 md:p-10">

                        <button
                            type="button"
                            wire:click="back"
                            class="mb-6 text-xs font-bold text-slate-400
                                   hover:text-slate-950"
                        >
                            ← Kembali
                        </button>


                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em]
                                       text-slate-400"
                            >
                                DownloadRumah
                            </span>

                            <h2
                                class="mt-2 text-xl font-black tracking-[-0.025em]
                                       text-slate-950 sm:text-2xl"
                            >
                                {{ $intent === 'search'
                                    ? 'Berapa kisaran budgetmu?'
                                    : 'Berapa harga yang kamu tawarkan?' }}
                            </h2>

                        </div>


                        <div class="mt-8 max-w-xl">

                            <label class="mb-2 block text-xs font-bold text-slate-600">
                                {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                            </label>

                            <div class="relative">

                                <span
                                    class="absolute inset-y-0 left-4 flex items-center
                                           text-sm font-bold text-slate-400"
                                >
                                    Rp
                                </span>

                                <input
                                    type="text"
                                    wire:model="budget"
                                    wire:keydown.enter="continueToPurpose"
                                    placeholder="500.000.000"
                                    class="w-full border border-slate-300 bg-slate-50
                                           py-4 pl-12 pr-4 text-sm font-medium
                                           text-slate-950 outline-none transition
                                           focus:border-slate-950 focus:bg-white"
                                >

                            </div>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <button
                                type="button"
                                wire:click="continueToPurpose"
                                class="bg-slate-950 px-5 py-3.5 text-xs font-bold
                                       text-white transition hover:bg-slate-800"
                            >
                                Lanjut →
                            </button>

                        </div>

                    </div>


                    {{-- ====================================================
                    STEP 5 — PURPOSE
                    ===================================================== --}}

                @elseif ($step === 5)

                    <div class="p-6 sm:p-8 md:p-10">

                        <button
                            type="button"
                            wire:click="back"
                            class="mb-6 text-xs font-bold text-slate-400
                                   hover:text-slate-950"
                        >
                            ← Kembali
                        </button>


                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em]
                                       text-slate-400"
                            >
                                DownloadRumah
                            </span>

                            <h2
                                class="mt-2 text-xl font-black tracking-[-0.025em]
                                       text-slate-950 sm:text-2xl"
                            >
                                {{ $intent === 'search'
                                    ? 'Apa yang paling penting buatmu?'
                                    : 'Menurutmu properti ini cocok untuk siapa?' }}
                            </h2>

                            <p
                                class="mt-2 text-sm font-medium leading-6 text-slate-500"
                            >
                                Pilih yang paling menggambarkan kebutuhanmu.
                            </p>

                        </div>


                        <div class="mt-8 grid grid-cols-1 gap-2 sm:grid-cols-2">

                            @foreach (
                                $intent === 'search'
                                    ? [
                                        'near_work' => 'Dekat tempat kerja',
                                        'near_campus' => 'Dekat kampus',
                                        'quiet' => 'Lingkungan tenang',
                                        'flood_free' => 'Bebas banjir',
                                    ]
                                    : [
                                        'family' => 'Keluarga',
                                        'student' => 'Mahasiswa',
                                        'business' => 'Usaha',
                                        'general' => 'Umum',
                                    ]
                                as $value => $label
                            )

                                <button
                                    type="button"
                                    wire:click="selectPurpose('{{ $value }}')"
                                    class="border border-slate-300 bg-slate-50
                                           px-4 py-4 text-left text-sm font-bold
                                           text-slate-700 transition
                                           hover:border-slate-950 hover:bg-white"
                                >
                                    {{ $label }}

                                    <span class="float-right text-slate-400">
                                        →
                                    </span>
                                </button>

                            @endforeach

                        </div>

                    </div>


                    {{-- ====================================================
                    STEP 6 — SUMMARY
                    ===================================================== --}}

                @elseif ($step === 6)

                    <div class="p-6 sm:p-8 md:p-10">

                        <div class="max-w-2xl">

                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.15em]
                                       text-sky-600"
                            >
                                Kebutuhanmu
                            </span>

                            <h2
                                class="mt-2 text-2xl font-black tracking-[-0.03em]
                                       text-slate-950 sm:text-3xl"
                            >
                                Sudah cukup jelas.
                            </h2>

                            <p
                                class="mt-3 text-sm font-medium leading-6 text-slate-500"
                            >
                                Ini yang akan kami gunakan untuk menemukan kecocokan.
                            </p>

                        </div>


                        <div
                            class="mt-8 divide-y divide-slate-200
                                   border-y border-slate-200"
                        >

                            <div class="flex items-center justify-between gap-6 py-4">

                                <span class="text-xs font-bold text-slate-400">
                                    Tujuan
                                </span>

                                <span class="text-sm font-bold text-slate-950">
                                    {{ $intent === 'search'
                                        ? 'Mencari properti'
                                        : 'Menawarkan properti' }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-6 py-4">

                                <span class="text-xs font-bold text-slate-400">
                                    Properti
                                </span>

                                <span class="text-sm font-bold text-slate-950">
                                    {{ match ($propertyType) {
                                        'house' => 'Rumah',
                                        'kos' => 'Kos',
                                        'land' => 'Tanah',
                                        'shop' => 'Ruko',
                                        default => 'Belum ditentukan',
                                    } }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-6 py-4">

                                <span class="text-xs font-bold text-slate-400">
                                    Lokasi
                                </span>

                                <span class="text-sm font-bold text-slate-950">
                                    {{ $location }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-6 py-4">

                                <span class="text-xs font-bold text-slate-400">
                                    {{ $intent === 'search' ? 'Budget' : 'Harga' }}
                                </span>

                                <span class="text-sm font-bold text-slate-950">
                                    Rp {{ $budget }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-6 py-4">

                                <span class="text-xs font-bold text-slate-400">
                                    Prioritas
                                </span>

                                <span class="text-sm font-bold text-slate-950">
                                    {{ match ($purpose) {
                                        'near_work' => 'Dekat tempat kerja',
                                        'near_campus' => 'Dekat kampus',
                                        'quiet' => 'Lingkungan tenang',
                                        'flood_free' => 'Bebas banjir',
                                        'family' => 'Keluarga',
                                        'student' => 'Mahasiswa',
                                        'business' => 'Usaha',
                                        'general' => 'Umum',
                                        default => '-',
                                    } }}
                                </span>

                            </div>

                        </div>


                        <div
                            class="mt-8 flex flex-col gap-3
                                   sm:flex-row sm:items-center
                                   sm:justify-between"
                        >

                            <button
                                type="button"
                                wire:click="resetMatching"
                                class="text-xs font-bold text-slate-400
                                       hover:text-slate-950"
                            >
                                Ubah kebutuhan
                            </button>


                            <button
                                type="button"
                                class="bg-slate-950 px-6 py-4 text-xs font-black
                                       text-white transition hover:bg-slate-800"
                            >
                                Lihat yang cocok →
                            </button>

                        </div>

                    </div>

                @endif

            </div>


            {{-- ========================================================
            STATUS
            ========================================================= --}}

            {{-- CHANGED: progress sekarang mengikuti 6 tahap --}}

            <div class="mt-4 flex items-center justify-between">

                <span
                    class="text-[10px] font-bold uppercase tracking-[0.15em]
                           text-slate-400"
                >
                    {{ $step }} / 6
                </span>

                <span class="text-[10px] font-medium text-slate-400">
                    {{ $intent === 'search'
                        ? 'Mencari properti'
                        : 'Menawarkan properti' }}
                </span>

            </div>

        </div>

    </div>

</x-layouts.structural-section>
