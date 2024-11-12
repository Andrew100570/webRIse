<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SearchFilesCommand extends Command
{
    /**
     * Имя и описание консольной команды.
     *
     * @var string
     */
    protected $signature = 'search:files'; // Так Мы обращаемся к команде комманде в консоли

    protected $description = 'Находит все файлы с именами,которые описаны в задании';

    /**
     * Создание нового экземпляра команды.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Выполнение команды.
     *
     * @return void
     */
    public function handle()
    {
        // Путь к папке /datafiles в каталоге storage,обычно там лежат файлы*
        $directoryPath = storage_path('datafiles'); // Путь к папке storage/datafiles

        if (!File::exists($directoryPath)) {
            $this->error("Папка datafiles не найдена.");
            return;
        }

        $allFiles = File::files($directoryPath);

        // Регулярное выражение для проверки имен файлов по заданию
        $pattern = '/^[a-zA-Z0-9]+\.(ixt)$/';

        $filteredFiles = [];

        foreach ($allFiles as $file) {
            $fileName = $file->getFilename();
            if (preg_match($pattern, $fileName)) {
                $filteredFiles[] = $fileName;
            }
        }

        if (empty($filteredFiles)) {
            $this->info("Файлы не найдены.");
            return;
        }

        // Сортируем имена файлов по алфавиту, как необходимо в задании
        sort($filteredFiles);

        $this->info("Найденные файлы:");
        foreach ($filteredFiles as $fileName) {
            $this->line($fileName);
        }
    }
}
