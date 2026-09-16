<?php
/**
 * Controller Documentation
 */

/* -------------- Yoga Wilanda Documentation V.1.1.6 --------------
| <meta_config>
| 0. Author_______________: yogawilanda <eayogawilanda@gmail.com>
| 1. Path_________________: ./docs-inline-php-guideline.php
| 2. Render_______________: return view('livewire.pages.home.sections.hero');
| 3. Usage________________: DownloadRumah — Guest Intent Controller
| 4. type_________________: Livewire Component
| 5. expected_data________: [intent, step, propertyType, searchState, location, budget, purpose]
| 6. purpose______________: Manage step navigation, form states, label resolution, and query payload assembly.
| 7. ruling_______________: Always update every changes following to this documentation.
| 8. ruling_structure_____: Action methods modify state -> Computed properties resolve dynamic labels & matching payload.
| 9. status_______________: Active
</meta_config>
----------------- For Livewire Component (Controller) ----------- */

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
