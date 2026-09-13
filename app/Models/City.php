<?php

/**
 * <meta_config>
 * @path             : app/Models/City.php
 * @usage            : Wrapper Model for Laravolt Indonesia City Entity
 * @type             : Package Wrapper Model (Virtual/External Schema)
 * @table            : indonesia_cities (Managed by Laravolt Package)
 *
 * @expected_attributes : [MAX 5-7 Attributes]
 *   - code (string)                       : Regional city code identifier (Char 4)
 *   - province_code (string)              : Linked province code (Char 2)
 *   - name (string)                       : City official name
 *
 * @expected_relations  : [MAX 3-5 Relationships]
 *   - province() (BelongsTo)              : Linked Laravolt Province model
 *
 * @scopes_and_methods  : [MAX 3-5 Scopes]
 *   - None (Inherited from LaravoltBaseModel)
 *
 * @ruling           : Max 100 total lines  . Exceed? Modularize via Concerns/Traits.
 * @overflow_action  : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * @ruling_scope     : CLEAN QUERYING. No custom business scopes should leak into third-party wrappers.
 * @ruling_type      : STRICT TYPE SAFETY. Extend Laravolt model cleanly without breaking package contracts.
 * @ruling_model     : SINGLE SOURCE OF TRUTH. Rely on Laravolt data structure for location mapping.
 * @ruling_ui        : NO UI LEAKAGE. Strictly used for geographical options in select forms.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Models;

use Laravolt\Indonesia\Models\City as LaravoltCity;

class City extends LaravoltCity
{
    // Menggunakan class Laravolt secara langsung
}
