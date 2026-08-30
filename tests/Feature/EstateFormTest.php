<?php

namespace Tests\Feature;

use App\Livewire\Pages\Estates\EstateForm;
use App\Livewire\Pages\Estates\EstateListing;
use App\Models\Estate;
use App\Models\EstateAttachment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class EstateFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_estate_form_requires_a_photo_before_saving(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(EstateForm::class)
            ->set('form.title', 'Rumah Baru')
            ->set('form.description', 'Deskripsi lengkap properti.')
            ->set('form.transaction_type', 'sale')
            ->set('form.property_type', 'house')
            ->set('form.price', 250000000)
            ->set('form.city', 'Bandung')
            ->call('save')
            ->assertHasErrors(['photos']);
    }

    public function test_uploaded_photo_is_persisted_and_available_on_my_listings(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(EstateForm::class)
            ->set('form.title', 'Rumah Dengan Foto')
            ->set('form.description', 'Deskripsi lengkap properti.')
            ->set('form.transaction_type', 'sale')
            ->set('form.property_type', 'house')
            ->set('form.price', 250000000)
            ->set('form.city', 'Bandung')
            ->set('photos', [UploadedFile::fake()->image('rumah.jpg')])
            ->call('save')
            ->assertRedirect(route('dashboard'));

        $estate = Estate::where('user_id', $user->id)->firstOrFail();
        $attachment = EstateAttachment::where('estate_id', $estate->id)->firstOrFail();

        Storage::disk('public')->assertExists($attachment->file_path);

        Livewire::actingAs($user)
            ->test(EstateListing::class)
            ->assertSee($attachment->url);
    }
}
