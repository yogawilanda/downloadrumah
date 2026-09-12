<?php

namespace App\Http\Controllers\Api;

use App\Actions\Estates\ProcessEstatePhotoAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FastStoreEstateRequest;
use App\Models\Estate;
use App\Models\EstateAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EstateApiController extends Controller
{
    public function fastStore(
        FastStoreEstateRequest $request,
        ProcessEstatePhotoAction $photoProcessor
    ): JsonResponse {
        $user = $request->user();
        $rawText = $request->input('raw_text');
        $estatesInput = $request->input('estates');

        if (!empty($rawText)) {
            // Solusi 1: Jika dikirim via raw_text
            $rawBlocks = preg_split('/[\r\n]*---[\r\n]*/', trim($rawText));
            $blocks = array_values(array_filter(array_map('trim', $rawBlocks)));
        } elseif (!empty($estatesInput) && is_array($estatesInput)) {
            // Solusi 2: Jika dikirim via Form-Data Array estates[0], estates[1]
            $blocks = $estatesInput;
        } else {
            // Fallback: Single input biasa
            $blocks = [
                $request->only([
                    'title',
                    'price',
                    'transaction_type',
                    'property_type',
                    'description',
                    'publicity_status',
                    'watermark'
                ])
            ];
        }

        if (empty($blocks)) {
            return response()->json([
                'success' => false,
                'message' => 'Format input tidak valid.',
            ], 422);
        }

        $uploadedPhotos = $request->file('photos', []);
        $createdEstates = [];

        DB::beginTransaction();
        try {
            foreach ($blocks as $index => $block) {
                $parsedData = is_string($block) ? $this->parseBlockText($block) : $block;

                $validator = Validator::make($parsedData, [
                    'title' => 'required|string|max:255',
                    'price' => 'required|numeric|min:0',
                    'transaction_type' => 'nullable|in:sale,rent,sale & rent',
                    'property_type' => 'nullable|string',
                    'description' => 'nullable|string',
                    'publicity_status' => 'nullable|in:draft,published',
                    'watermark' => 'nullable|boolean',
                ]);

                if ($validator->fails()) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Validasi gagal pada iklan ke-' . ($index + 1),
                        'errors' => $validator->errors(),
                    ], 422);
                }

                $validated = $validator->validated();

                // Handling foto
                $blockPhotos = [];
                if (isset($uploadedPhotos[$index])) {
                    $blockPhotos = is_array($uploadedPhotos[$index])
                        ? $uploadedPhotos[$index]
                        : [$uploadedPhotos[$index]];
                }

                $hasPhotos = !empty($blockPhotos);
                $publicityStatus = $validated['publicity_status'] ?? ($hasPhotos ? 'published' : 'draft');
                $useWatermark = isset($validated['watermark'])
                    ? (bool) $validated['watermark']
                    : $request->boolean('watermark', false);

                $estate = Estate::create([
                    'user_id' => $user->id,
                    'title' => trim($validated['title']),
                    'slug' => Str::slug($validated['title']) . '-' . Str::random(5),
                    'price' => (float) $validated['price'],
                    'transaction_type' => $validated['transaction_type'] ?? 'sale',
                    'property_type' => $validated['property_type'] ?? 'house',
                    'description' => $validated['description'] ?? null,
                    'publicity_status' => $publicityStatus,
                    'transaction_status' => 'available',
                ]);

                if ($hasPhotos) {
                    foreach ($blockPhotos as $photoIndex => $photo) {
                        $storedPath = $photoProcessor->execute($photo, $useWatermark);

                        EstateAttachment::create([
                            'estate_id' => $estate->id,
                            'file_path' => $storedPath,
                            'is_primary' => ($photoIndex === 0),
                            'sort_order' => $photoIndex,
                        ]);
                    }
                }

                $estate->load('primaryImage');

                $createdEstates[] = [
                    'id' => $estate->id,
                    'title' => $estate->title,
                    'slug' => $estate->slug,
                    'price' => $estate->price,
                    'watermark_applied' => $useWatermark,
                    'publicity_status' => $estate->publicity_status,
                    'og_image_url' => $estate->primaryImage?->url,
                    'catalog_url' => route('catalog.detail', [
                        'username' => $user->username ?? $user->id,
                        'estate' => $estate->slug,
                    ]),
                ];
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => count($createdEstates) . ' properti berhasil disimpan kilat!',
                'data' => $createdEstates,
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function parseBlockText(string $block): array
    {
        $data = [];

        // Match semua pasangan key:value (contoh: title:Rumah, price:1000, dst)
        // Regex ini tahan terhadap spasi, enter (\n), maupun Windows newline (\r\n)
        preg_match_all('/([a-zA-Z_]+)\s*:\s*([^:\n\r]+(?:\n(?![a-zA-Z_]+:)[^:\n\r]+)*)/', $block, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $key = trim($match[1]);
            $value = trim($match[2]);
            $data[$key] = $value;
        }

        return $data;
    }
}
