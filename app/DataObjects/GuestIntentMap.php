<?php

namespace App\DataObjects;

/* ------------------------------------------------------------------------------------------------------
| <meta_config>
| @path                : app/DataObjects/GuestIntentMap.php
| @usage               : DownloadRumah — Guest Intent Definition & Matching Pointers
| @type                : Domain Data Mapping
| @expected_data       : [intents, search_states, property_types, purposes]
| @purpose             : Centralize user-facing intent labels and semantic pointers used by the matching flow.
| @ruling               : UI text remains editable without changing matching semantics. Pointers are the stable identifiers.
| @ruling_structure     : Intent → State / Property Type / Purpose → Pointer
| @status               : Intent Experience — Prototype / Refactor
| @author               : yogawilanda <eaywilanda@gmail.com>
</meta_config>
-------------------------------------------------------------------------------------------------------- */

class GuestIntentMap
{
    public static function map(): array
    {
        return [
            'intents' => [
                'search' => [
                    'label' => 'Saya mencari properti',
                ],
                'offer' => [
                    'label' => 'Saya punya properti',
                ],
            ],
            'search_states' => [
                'known' => [
                    'label' => 'Saya sudah tahu yang saya cari',
                ],
                'browsing' => [
                    'label' => 'Saya masih lihat-lihat',
                ],
                'undecided' => [
                    'label' => 'Saya belum yakin',
                ],
                'comparing' => [
                    'label' => 'Saya sedang membandingkan',
                ],
                'starting' => [
                    'label' => 'Saya baru mulai mencari',
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
