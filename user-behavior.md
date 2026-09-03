# Analytics and User Activity Monitoring Specification

1. Overview and Objective
Sistem ini dirancang untuk merekam lalu lintas (traffic) dan perilaku pengguna (behavior) dari awal kunjungan. Data ini digunakan sebagai acuan pengembangan fitur aplikasi.

2. Tracking Strategy
- Level 1 (Traffic): Otomatis mencatat pembukaan halaman (page_view) untuk mengetahui alur navigasi utama.
- Level 2 (Feature Interaction): Mencatat interaksi pengguna pada fitur kunci (filter, tombol WhatsApp) untuk mengetahui tingkat penggunaan fitur.

3. Key Events Checklist
- Modul Traffic:
  * Event: page_view
  * Trigger: Setiap halaman dimuat
  * Payload: URL dan Referrer
- Modul Estates:
  * Event: search_filter_applied
  * Trigger: User menerapkan filter pencarian
  * Payload: Kriteria filter (lokasi, tipe properti, range harga)
  * Event: contact_agent_clicked
  * Trigger: User mengklik tombol kontak agen
  * Payload: ID Properti dan channel kontak

4. Technical Implementation Steps

Step 1: Migration Table (database/migrations/2026_09_03_000001_create_activity_logs_table.php)
<?php

/**
 * <meta_config>
 * @path : database/migrations/2026_09_03_000001_create_activity_logs_table.php | usage: User Activity Schema
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('module', 50)->index();
            $table->string('event_name', 100)->index();
            $table->json('payload')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['module', 'event_name', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};

Step 2: Middleware Level 1 (app/Http/Middleware/LogPageView.php)
<?php

/**
 * <meta_config>
 * @path : app/Http/Middleware/LogPageView.php | usage: Level 1 Traffic Middleware
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->is('storage/*', 'build/*', 'favicon.ico')) {
            return $response;
        }

        try {
            DB::table('activity_logs')->insert([
                'user_id'    => auth()->id(),
                'module'     => 'traffic',
                'event_name' => 'page_view',
                'payload'    => json_encode(['url' => $request->fullUrl()]),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Pageview Logging Failed: ' . $e->getMessage());
        }

        return $response;
    }
}

Step 3: API Controller Level 2 (app/Http/Controllers/Api/ActivityLogController.php)
<?php

/**
 * <meta_config>
 * @path : app/Http/Controllers/Api/ActivityLogController.php | usage: API Endpoint for Event Telemetry
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'module'     => 'required|string|max:50',
            'event_name' => 'required|string|max:100',
            'payload'    => 'nullable|array',
        ]);

        try {
            DB::table('activity_logs')->insert([
                'user_id'    => auth('sanctum')->id() ?? auth()->id(),
                'module'     => $validated['module'],
                'event_name' => $validated['event_name'],
                'payload'    => isset($validated['payload']) ? json_encode($validated['payload']) : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success'], 201);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

Step 4: JavaScript Helper (resources/js/app.js)
window.trackEvent = function(module, eventName, payload = {}) {
    if (!window.navigator.onLine) return;

    fetch('/api/v1/log-activity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            module: module,
            event_name: eventName,
            payload: payload
        })
    }).catch(err => console.error('[Analytics Error]', err));
};

5. Best Practices
- Pastikan logging tidak menghambat UX (gunakan fail-safe try-catch).
- Lakukan rotasi/pembersihan data log berkala agar database tidak membengkak.
- Jangan menyimpan informasi sensitif (password, finansial) pada JSON payload.
