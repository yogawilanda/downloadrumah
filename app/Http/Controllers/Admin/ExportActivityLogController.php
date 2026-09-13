<?php

/**
 * <meta_config>
 * @path             : app/Http/Controllers/Admin/ExportActivityLogController.php
 * @usage            : Direct Streamed CSV Download Handler for System Activity Logs
 * @type             : Single Action Controller (Invokable Controller)
 *
 * @expected_params  : None (Invokable Route via GET /admin/insights/export)
 * @expected_output  : Symfony\Component\HttpFoundation\StreamedResponse (CSV Stream File)
 *
 * @tech_debt        : [UI Integration & Stream Export Audit]
 *   - UNLINKED BLADE UI BUTTON (Pending) : Controller export backend sudah siap & berfungsi, namun elemen tombol 'Export CSV' belum terpasang di view `search-filter-toolbar.blade.php`.
 *   - MEMORY OPTIMIZATION : Sudah menerapkan `lazy(500)` dan `php://output` stream untuk mencegah memory leak pada dataset besar.
 *
 * @ruling           : Max 100 total lines of code. Exceed? Modularize via Service/Action.
 * @ruling_scope     : SINGLE ACTION INVOCATION. Strictly handles CSV streaming response.
 * @ruling_auth      : STRICT AUTH GUARD. Abort 404 for unauthenticated or non-admin access.
 *
 * @created | updated : 25/09/2026 | 13/09/2026
 * @author           : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportActivityLogController extends Controller
{
    public function __invoke(): StreamedResponse
    {
        // Guard: Jika tidak login atau bukan admin, lempar 404
        if (! Auth::check() || ! Auth::user()->is_super_admin) {
            abort(404);
        }

        $fileName = 'activity-logs-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'User ID', 'Module', 'Event', 'IP Address', 'Created At']);

            ActivityLog::select('id', 'user_id', 'module', 'event_name', 'ip_address', 'created_at')
                ->latest()
                ->lazy(500)
                ->each(function ($log) use ($handle) {
                    fputcsv($handle, [
                        $log->id,
                        $log->user_id ?? 'Guest',
                        $log->module,
                        $log->event_name,
                        $log->ip_address,
                        $log->created_at->toDateTimeString(),
                    ]);
                });

            fclose($handle);
        }, $fileName, ['Content-Type' => 'text/csv']);
    }
}
