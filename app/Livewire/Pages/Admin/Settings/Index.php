<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Admin/Settings/Index.php | usage: Super admin settings dashboard
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * </meta_config>
 */

namespace App\Livewire\Pages\Admin\Settings;

use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pengaturan Aplikasi')]
#[Layout('components.layouts.app')]
class Index extends Component
{
    /**
     * Per-row in-memory edit buffer keyed by setting id.
     * @var array<int,string>
     */
    public array $drafts = [];

    /**
     * Track which key is currently being saved (for spinner state).
     */
    public ?int $savingId = null;

    /**
     * Feedback message shown after a save.
     */
    public ?string $flash = null;

    public function mount(): void
    {
        // Pre-populate drafts so the input binds correctly on first render.
        $this->drafts = Setting::query()
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->mapWithKeys(fn ($s) => [$s->id => (string) $s->value])
            ->all();
    }

    #[Computed]
    public function grouped()
    {
        return Setting::query()
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->groupBy('group');
    }

    public function save(int $id, SettingsService $service): void
    {
        $this->savingId = $id;
        $row = Setting::findOrFail($id);

        $service->set($row->key, $this->drafts[$id] ?? null, Auth::id());

        $this->savingId = null;

        // Settings used by dynamic_throttle middleware take effect on the very next request.
        $isHotReload = str_starts_with($row->key, 'throttle.');
        $suffix = $isHotReload ? ' Berlaku untuk request berikutnya (tanpa restart).' : '';

        $this->flash = "✅ Pengaturan \"{$row->label}\" berhasil disimpan.{$suffix}";
    }

    public function flushCache(SettingsService $service): void
    {
        $service->flush();
        $this->flash = '♻️ Cache pengaturan dikosongkan.';
    }

    public function render()
    {
        return view('livewire.pages.admin.settings.index');
    }
}
