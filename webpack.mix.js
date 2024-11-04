const mix = require('laravel-mix');

// Скомпилируем JavaScript файл
mix.js('resources/js/app.js', 'public/js')
// Скомпилируем SASS файл
    .sass('resources/sass/app.scss', 'public/css')
    // Используйте .version() для создания версии файла
    .version();
