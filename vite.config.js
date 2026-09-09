/*
|--------------------------------------------------------------------------
| Context & Meta Configuration
|--------------------------------------------------------------------------
| @path   : vite.config.js
| @usage  : Vite build pipeline configuration for Tailwind v4 & Laravel 13
| @ruling : max line of code 80%, max doc 20% | max total lines = 100
| @author : yogawilanda <eayogawilanda@gmail.com>
|--------------------------------------------------------------------------
*/

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: ["resources/views/**", "app/Livewire/**"],
            preloadTagConfig: {
                rel: "stylesheet",
            },
        }),
        tailwindcss(),
    ],
});
