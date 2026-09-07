<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/EnsureSuperAdmin.php | usage: Gate the super admin surface with automatic redirects
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    /**
     * Ensure the authenticated user has the super_admin role flag.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. Jika belum login, redirect ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. Cek privilese via method isSuperAdmin() di model User
        $isSuperAdmin = method_exists($user, 'isSuperAdmin')
            ? $user->isSuperAdmin()
            : (bool) ($user->is_super_admin ?? false);

        // 3. Jika BUKAN Super Admin, pura-pura halaman tidak ada (404)
        if (!$isSuperAdmin) {
            abort(404);
        }

        return $next($request);
    }
}
