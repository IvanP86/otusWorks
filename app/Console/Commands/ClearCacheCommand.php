<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache:clear {key}';

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
        Cache::store('memcached')->forget($key);
        $this->line('Очищен кеш ' . $key);
    }
}
