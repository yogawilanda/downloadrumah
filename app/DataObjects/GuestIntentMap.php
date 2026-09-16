<?php
/* -------------- Yoga Wilanda Documentation V.1.0.0 -----------------
| <meta_config>
| Author_______________: yogawilanda <eayogawilanda@gmail.com>
| Path_________________: app/DataObjects/GuestIntentMap.php
| Usage________________: DownloadRumah — Guest Intent Semantic Mapping
| Type_________________: Data Object / Static Data Mapping
| expected_data________: [intents, search_states, property_types, purposes]
| purpose______________: Centralize user-facing labels and semantic pointers
|                         used by the guest intent experience and matching flow.
| ruling_______________: UI labels may change without changing the semantic
|                         identifiers used by the matching layer.
| ruling_structure_____: Intent -> State / Property Type / Purpose -> Pointer
| status_______________: Active
</meta_config>
-------------- For Data Objects like Map, Array, Or List ----------- */



namespace App\DataObjects;


class GuestIntentMap
{
    public static function map(): array
    {
        return [
            'intents' => [
                'search' => [
                    'label' => 'mencari properti',
                ],
                'offer' => [
                    'label' => 'punya properti',
                ],
            ],
            'search_states' => [
                'known' => [
                    'label' => 'sudah tahu yang cari',
                ],
                'browsing' => [
                    'label' => 'mau lihat lihat dulu',
                ],
                'undecided' => [
                    'label' => 'belum yakin',
                ],
                'comparing' => [
                    'label' => 'sedang membandingkan',
                ],
                'starting' => [
                    'label' => 'baru mulai mencari',
                ],
            ],
            'property_types' => [
                'house' => [
                    'label' => 'Rumah',
                    'pointer' => 'property.house',
                ],
                'kos' => [
                    'label' => 'Kos',
                    'pointer' => 'property.kos',
                ],
                'land' => [
                    'label' => 'Tanah',
                    'pointer' => 'property.land',
                ],
                'shop' => [
                    'label' => 'Ruko',
                    'pointer' => 'property.shop',
                ],
            ],
            'purposes' => [
                'search' => [
                    'near_work' => [
                        'label' => 'Dekat tempat kerja',
                        'pointer' => 'priority.near_work',
                    ],
                    'near_campus' => [
                        'label' => 'Dekat kampus',
                        'pointer' => 'priority.near_campus',
                    ],
                    'quiet' => [
                        'label' => 'Lingkungan tenang',
                        'pointer' => 'priority.quiet',
                    ],
                    'flood_free' => [
                        'label' => 'Bebas banjir',
                        'pointer' => 'priority.flood_free',
                    ],
                ],
                'offer' => [
                    'family' => [
                        'label' => 'Keluarga',
                        'pointer' => 'audience.family',
                    ],
                    'student' => [
                        'label' => 'Mahasiswa',
                        'pointer' => 'audience.student',
                    ],
                    'business' => [
                        'label' => 'Usaha',
                        'pointer' => 'audience.business',
                    ],
                    'general' => [
                        'label' => 'Umum',
                        'pointer' => 'audience.general',
                    ],
                ],
            ],
        ];
    }
}
