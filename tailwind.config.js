import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        //'./vendor/awcodes/curator/resources/views/**/*.blade.php',
    ],
    //presets: [preset],
    presets:[defaultTheme],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './app/Livewire/**/*.php',
        './resources/views/livewire/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    plugins: [forms, typography],
}