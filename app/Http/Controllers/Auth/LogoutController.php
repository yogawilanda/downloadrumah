<?php

/**
 * <meta_config>
 * @path             : app/Http/Controllers/Auth/LogoutController.php
 * @usage            : Single Action Controller for Invalidating User Web Session & Auth Guard
 * @type             : Single Action Controller (Invokable Controller)
 *
 * @expected_params  : Illuminate\Http\Request $request
 * @expected_output  : Illuminate\Http\RedirectResponse
 *
 * @ruling           : Max 100 total lines of code.
 * @ruling_scope     : SINGLE ACTION INVOCATION. Encapsulates session flushing & web guard logout.
 *
 * @created | updated : 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
