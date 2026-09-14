<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml dinamis untuk GSC & AI Crawlers.
     */
    public function __invoke(): Response
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // 1. Static Public Pages
        $xml .= '<url><loc>' . route('home') . '</loc><priority>1.0</priority></url>';
        $xml .= '<url><loc>' . route('mortgage.calculator') . '</loc><priority>0.8</priority></url>';
        $xml .= '<url><loc>' . route('privacy') . '</loc><priority>0.3</priority></url>';
        $xml .= '<url><loc>' . route('terms') . '</loc><priority>0.3</priority></url>';

        // 2. Dynamic Public Estate Details (Pakai scopeActive & Eager Load relation user)
        $estates = Estate::active()
            ->with(['user:id,username'])
            ->select('id', 'user_id', 'slug', 'updated_at')
            ->get();

        foreach ($estates as $estate) {
            // Abaikan jika username owner/agen tidak terdeteksi
            if (! $estate->user?->username) {
                continue;
            }

            $url = route('catalog.detail', [
                'username' => $estate->user->username,
                'estate'   => $estate->slug,
            ]);

            $xml .= '<url>';
            $xml .= '<loc>' . $url . '</loc>';
            $xml .= '<lastmod>' . $estate->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
