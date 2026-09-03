<?php

/**
 * <meta_config>
 * @path : app/Http/Requests/StoreActivityLogRequest.php | usage: Form Request Validation for Activity Log
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rule()
    {
        return [
            'module' => ['required', 'string', 'max:50'],
            'event_name' => ['required', 'string', 'max:100'],
            'payload' => ['nullable', 'array'],
        ];
    }
}
