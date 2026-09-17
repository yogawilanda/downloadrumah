<?php

/* -------------- Yoga Wilanda Documentation V.1.1.7 -----------------
| <meta_config>
| Author_______________: yogawilanda <eayogawilanda@gmail.com>
| Path_________________: app/Services/Matching/GuestMatchingService.php
| Usage________________: DownloadRumah — Guest Property Matching Service
| Type_________________: Application Service
| expected_data________: [payload]
| expected_output______: [results, explanation]
| purpose______________: Execute guest property matching independently from
|                        Livewire presentation and interaction state.
| ruling_______________: Matching logic MUST remain outside Livewire components.
|                        The service interprets guest matching payloads and
|                        prepares property results with transparent evidence.
| ruling_evidence______: Every result should expose what matched, what remains
|                        unverified, what was relaxed, and what conflicts with
|                        the user's request.
| ruling_widening______: Matching may widen criteria when exact results are
|                        insufficient, but every relaxation MUST be explicit.
| ruling_scope_________: Service coordinates matching behavior.
|                        Complex query construction may later be isolated into
|                        Query Classes.
| status_______________: Active
</meta_config>
------------------------------------------------------------------ */

namespace App\Services\Matching;

use App\Models\Estate;
use App\Services\CityService;

class GuestMatchingService
{
    public function __construct(
        private CityService $cityService,
    ) {
    }

    /**
     * Resolve semantic property pointer into Estate storage value.
     *
     * Important:
     * Unsupported semantic intents MUST NOT be silently mapped
     * to another property type.
     */
    private function resolvePropertyType(?string $pointer): ?string
    {
        return match ($pointer) {
            'property.house' => 'house',
            'property.land'  => 'land',
            'property.shop'  => 'shophouse',

            // Understood by the intent layer, but not supported
            // by the current Estate inventory.
            'property.kos'   => null,

            default => null,
        };
    }

    /**
     * Execute exact guest property matching.
     *
     * V1 criteria:
     * - location
     * - supported property type
     * - budget
     *
     * Unsupported semantic criteria remain visible as unverified.
     *
     * @param array $payload
     * @return array
     */
    public function match(array $payload): array
    {
        $location = trim((string) ($payload['location'] ?? ''));

        $city = $this->cityService->findByName($location);

        if (!$city) {
            return [
                'results' => [],
                'explanation' => [
                    'matched' => [],
                    'unverified' => [
                        'location' => 'Lokasi belum dapat diverifikasi.',
                    ],
                    'relaxed' => [],
                    'conflict' => [],
                ],
            ];
        }

        $propertyPointer = $payload['property_pointer'] ?? null;

        $propertyType = $this->resolvePropertyType($propertyPointer);

        /*
         * The semantic intent is understood, but the current inventory
         * cannot represent it.
         *
         * DO NOT continue the query without a property_type filter,
         * otherwise property.kos would accidentally return houses,
         * land, etc.
         */
        if ($propertyPointer && !$propertyType) {
            return [
                'results' => [],
                'explanation' => [
                    'matched' => [
                        'location',
                    ],
                    'unverified' => $this->unverifiedCriteria($payload),
                    'relaxed' => [],
                    'conflict' => [],
                ],
            ];
        }

        $query = Estate::query()
            ->active()
            ->where('city_id', $city->code);

        if ($propertyType) {
            $query->where('property_type', $propertyType);
        }

        $budget = $payload['budget'] ?? null;

        if ($budget !== null && $budget !== '') {
            $query->where('price', '<=', $budget);
        }

        $estates = $query
            ->with('primaryImage')
            ->latest()
            ->limit(20)
            ->get();

        $results = $estates
            ->map(function (Estate $estate) use ($payload, $city) {
                return [
                    'estate' => $estate,

                    'evidence' => [
                        'matched' => $this->resultMatchedCriteria(
                            $estate,
                            $payload,
                            $city
                        ),

                        'unverified' => $this->unverifiedCriteria(
                            $payload
                        ),

                        'relaxed' => [],

                        'conflict' => [],
                    ],
                ];
            })
            ->values()
            ->all();

        return [
            'results' => $results,

            'explanation' => [
                'matched' => $this->matchedCriteria($payload),

                'unverified' => $this->unverifiedCriteria(
                    $payload
                ),

                'relaxed' => [],

                'conflict' => [],
            ],
        ];
    }

    /**
     * Criteria verified by the exact matcher globally.
     */
    private function matchedCriteria(array $payload): array
    {
        $matched = [];

        if (!empty($payload['location'])) {
            $matched[] = 'location';
        }

        $propertyPointer = $payload['property_pointer'] ?? null;

        if ($this->resolvePropertyType($propertyPointer)) {
            $matched[] = 'property_type';
        }

        $budget = $payload['budget'] ?? null;

        if ($budget !== null && $budget !== '') {
            $matched[] = 'budget';
        }

        return $matched;
    }

    /**
     * Criteria verified for an individual Estate result.
     */
    private function resultMatchedCriteria(
        Estate $estate,
        array $payload,
        $city
    ): array {
        $matched = [
            'location' => $city->name,
        ];

        $propertyType = $this->resolvePropertyType(
            $payload['property_pointer'] ?? null
        );

        if ($propertyType) {
            $matched['property_type'] = $estate->property_type;
        }

        $budget = $payload['budget'] ?? null;

        if ($budget !== null && $budget !== '') {
            $matched['budget'] = $estate->price <= $budget;
        }

        return $matched;
    }

    /**
     * Identify semantic criteria that V1 cannot verify yet.
     */
    private function unverifiedCriteria(array $payload): array
    {
        $unverified = [];

        $propertyPointer = $payload['property_pointer'] ?? null;

        if ($propertyPointer === 'property.kos') {
            $unverified[$propertyPointer] =
                'Jenis properti ini belum tersedia dalam inventori saat ini.';
        }

        $purpose = $payload['purpose_pointer'] ?? null;

        if ($purpose) {
            $unverified[$purpose] =
                'Belum dapat diverifikasi dari data properti saat ini.';
        }

        return $unverified;
    }
}
