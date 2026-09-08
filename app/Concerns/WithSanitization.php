<?php

/**
 * --------------------------------------------------------------------------
 * Concern: Reactive Input Sanitization Engine
 * --------------------------------------------------------------------------
 * @path : app/Concerns/WithSanitization.php
 * @usage : Trait for sanitizing incoming reactive user inputs defensively
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100
 * @author : yogawilanda <eayogawilanda@gmail.com>
 * --------------------------------------------------------------------------
 */

namespace App\Concerns;

trait WithSanitization
{
    /**
     * Sanitasi email: buang spasi, karakter XSS, dan simbol injeksi SQLi
     */
    protected function sanitizeEmail(?string $email): string
    {
        if (! $email) return '';

        return preg_replace('/[\'%"<>]/', '', strtolower(trim($email)));
    }

    /**
     * Sanitasi teks umum (nama, search, komentar): strip HTML tags & extra whitespace
     */
    protected function sanitizeText(?string $text): string
    {
        if (! $text) return '';

        return preg_replace('/\s+/', ' ', strip_tags(trim($text)));
    }

    /**
     * Normalisasi nomor telepon/WA secara kondisional
     * If 0 -> 62 | if + (will it be invalid if input type is number?)
     */
    protected function sanitizePhone(?string $phone): string
    {
        if (! $phone) return '';

        $trimmed = trim($phone);
        $hasPlus = str_starts_with($trimmed, '+');
        $digits = preg_replace('/[^0-9]/', '', $trimmed);

        if (empty($digits)) return '';

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        if ($hasPlus) {
            return '+' . $digits;
        }

        return $digits;
    }

    /**
     * Sanitasi input nominal/angka murni (buang Rp, titik, koma, spasi)
     */
    protected function sanitizeNumber(?string $number): int
    {
        if (! $number) return 0;

        return (int) preg_replace('/[^0-9]/', '', $number);
    }

    /**
     * Sanitasi username/slug (hanya huruf kecil, angka, dan hyphen)
     */
    protected function sanitizeSlug(?string $slug): string
    {
        if (! $slug) return '';

        return preg_replace('/[^a-z0-9-]/', '', strtolower(trim($slug)));
    }
}
