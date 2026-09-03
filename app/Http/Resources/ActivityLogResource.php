<?php

/**
 * <meta_config>
 * @path : app/Http/Resources/ActivityLogResource.php | usage: API Resource Transformation with ID Obfuscation
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    /**
     * Obfuscate ID into simple URL-safe string without external packages.
     */
    private function maskId(int|string|null $id): ?string
    {
        return $id ? base_convert((string) ($id + 100000), 10, 36) : null;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'module' => $this->module,
            'event_name' => $this->event_name,
            'payload' => $this->payload,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->maskId($this->user->id),
                'name' => $this->user->name,
                'email' => $this->user->email ?? null,
            ]),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
