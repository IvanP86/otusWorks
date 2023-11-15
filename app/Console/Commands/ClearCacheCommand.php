<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

require __DIR__ . '/../../../vendor/autoload.php';
if (!class_exists('Memcached')) {
    include("memcached.php");
}

class ClearCacheCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clearC {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Убиваем кеш по имени';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        $this->line('Очищен кеш ' . $key);
        Cache::store('memcached')->forget($key);
    }
}
