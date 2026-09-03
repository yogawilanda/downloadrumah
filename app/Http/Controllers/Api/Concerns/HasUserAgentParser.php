<?php

/**
 * <meta_config>
 * @path : app/Http/Controllers/Api/Concerns/HasUserAgentParser.php | usage: User Agent Helper Trait
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Controllers\Api\Concerns;

trait HasUserAgentParser
{
    /**
     * Parse Raw User Agent to Readable Format (e.g. "Desktop - Google Chrome")
     */
    protected function parseUserAgent(?string $userAgent): string
    {
        if (! $userAgent) return 'Unknown Device';

        $device = preg_match('/(android|bb\d+|meego).+mobile|blackberry|iphone|ipod|ipad/i', $userAgent) ? 'Mobile' : 'Desktop';

        $browser = 'Unknown Browser';
        if (preg_match('/edg/i', $userAgent)) $browser = 'Edge';
        elseif (preg_match('/chrome|crios/i', $userAgent)) $browser = 'Google Chrome';
        elseif (preg_match('/firefox|fxios/i', $userAgent)) $browser = 'Firefox';
        elseif (preg_match('/safari/i', $userAgent)) $browser = 'Safari';

        return "{$device} - {$browser}";
    }
}
