<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Admin/Insights/Index.php | usage: Livewire component for Insights & Journey Trace
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Admin\Insights;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?string $selectedSessionId = null;
    public ?string $activeCardDetail = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function inspectJourney(string $sessionId): void
    {
        $this->selectedSessionId = $sessionId;
    }

    public function closeJourney(): void
    {
        $this->selectedSessionId = null;
    }

    public function openCardDetail(string $type): void
    {
        $this->activeCardDetail = $type;
    }

    public function closeCardDetail(): void
    {
        $this->activeCardDetail = null;
    }

    /**
     * Get aggregated breakdown data for active card modal.
     */
    private function getCardDetailsData(): Collection
    {
        return match ($this->activeCardDetail) {
            'pages' => ActivityLog::select('payload->url as full_url', DB::raw('count(*) as total'))
                ->whereNotNull('payload->url')
                ->groupBy('payload->url')
                ->orderByDesc('total')
                ->limit(10)
                ->get()
                ->map(function ($item) {
                        // Formatting URL agar cuma tampilkan PATH ringkas
                        $item->key_name = parse_url($item->full_url, PHP_URL_PATH) ?: '/';
                        return $item;
                    }),
            'users' => ActivityLog::select(DB::raw("COALESCE(users.name, 'Guest') as key_name"), DB::raw('count(activity_logs.id) as total'))
                ->leftJoin('users', 'users.id', '=', 'activity_logs.user_id')
                ->groupBy('key_name')->orderByDesc('total')->limit(10)->get(),
            'sessions' => ActivityLog::select('payload->session_id as key_name', DB::raw('count(*) as total'))
                ->whereNotNull('payload->session_id')->groupBy('payload->session_id')->orderByDesc('total')->limit(10)->get(),
            'events' => ActivityLog::select('event_name as key_name', DB::raw('count(*) as total'))
                ->groupBy('event_name')->orderByDesc('total')->limit(10)->get(),
            default => collect(),
        };
    }

    public function render(): View
    {
        $totalHits = ActivityLog::count();
        $uniqueSessions = ActivityLog::whereNotNull('payload->session_id')->distinct('payload->session_id')->count('payload->session_id');
        $authenticatedLogs = ActivityLog::whereNotNull('user_id')->count();
        $guestLogs = $totalHits - $authenticatedLogs;

        $topPageRaw = ActivityLog::select('payload->url as url', DB::raw('count(*) as total'))
            ->whereNotNull('payload->url')->groupBy('payload->url')->orderByDesc('total')->first();

        // paginate cukup 10
        $logs = ActivityLog::with('user:id,name,email')
            ->when($this->search !== '', fn($q) => $q->where('event_name', 'like', "%{$this->search}%")
                ->orWhere('ip_address', 'like', "%{$this->search}%")
                ->orWhere('payload->url', 'like', "%{$this->search}%"))
            ->latest()->paginate(10);

        $journeyLogs = $this->selectedSessionId
            ? ActivityLog::with('user:id,name')->where('payload->session_id', $this->selectedSessionId)->oldest()->get()
            : collect();

        return view('livewire.pages.admin.insights.index', [
            'totalHits' => $totalHits,
            'uniqueSessions' => $uniqueSessions,
            'authenticatedLogs' => $authenticatedLogs,
            'guestLogs' => $guestLogs,
            'topPage' => $topPageRaw ? (parse_url($topPageRaw->url, PHP_URL_PATH) ?: '/') : '/',
            'logs' => $logs,
            'journeyLogs' => $journeyLogs,
            'cardDetailsData' => $this->getCardDetailsData(),
        ]);
    }
}
