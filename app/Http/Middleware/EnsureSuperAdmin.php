<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/EnsureSuperAdmin.php | usage: Gate the super admin surface
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

        if (!$user) {
            abort(401, 'Anda harus login terlebih dahulu.');
        }

        // Use a "is_super_admin" boolean flag on the users table (fallback to env).
        $isSuperAdmin = method_exists($user, 'isSuperAdmin')
            ? $user->isSuperAdmin()
            : ($user->is_super_admin ?? false) || (bool) env('SUPER_ADMIN_IDS', false) && in_array($user->id, (array) env('SUPER_ADMIN_IDS', []));

        if (!$isSuperAdmin) {
            abort(403, 'Akses ditolak. Hanya super admin yang dapat membuka halaman ini.');
        }

        return $next($request);
    }
}
