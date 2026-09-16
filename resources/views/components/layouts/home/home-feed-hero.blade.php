@props([
    'categories' => [
        [
            'value' => '',
            'label' => 'Semua',
            'icon' => 'home',
        ],
        [
            'value' => 'rumah',
            'label' => 'Rumah',
            'icon' => 'building',
        ],
        [
            'value' => 'apartemen',
            'label' => 'Apartemen',
            'icon' => 'apartment',
        ],
        [
            'value' => 'ruko',
            'label' => 'Ruko',
            'icon' => 'shop',
        ],
        [
            'value' => 'tanah',
            'label' => 'Tanah',
            'icon' => 'land',
        ],
    ],
])

<div class="px-4">

    <div class="flex items-center gap-3 overflow-x-auto py-1 no-scrollbar">

        @foreach ($categories as $category)

            <button
                type="button"
                wire:click="$set('category', '{{ $category['value'] }}')"
                class="group flex shrink-0 flex-col items-center gap-1.5"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center
                           border border-slate-200 bg-white text-slate-500
                           transition-colors duration-150
                           group-hover:border-sky-500 group-hover:bg-sky-600
                           group-hover:text-white
                           dark:border-slate-700 dark:bg-slate-900
                           dark:text-slate-400
                           dark:group-hover:border-sky-500
                           dark:group-hover:bg-sky-600
                           dark:group-hover:text-white"
                >

                    @switch ($category['icon'])

                        @case('home')

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                            </svg>

                            @break

                        @case('building')

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                />
                            </svg>

                            @break

                        @case('apartment')

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                                />
                            </svg>

                            @break

                        @case('shop')

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                                />
                            </svg>

                            @break

                        @case('land')

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"
                                />
                            </svg>

                            @break

                    @endswitch

                </div>


                <span
                    class="text-[11px] font-medium text-slate-700
                           dark:text-slate-300"
                >
                    {{ $category['label'] }}
                </span>

            </button>

        @endforeach

    </div>

</div>
