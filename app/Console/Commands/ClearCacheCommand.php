<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Services\CacheUserService;
use App\Models\User;

class ClearCacheCommand extends Command
{
    public function __construct(public readonly CacheUserService $cacheUserService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache:clear
                                {--email : User email}';

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
        if (!$this->option('email')) {
            $choise = $this->choice('Выберете какой кеш нужно удалить:', ['All users', 'Single user//users', 'Categories', 'All'], 'All');
            switch ($choise) {
                case 'All users':
                    $this->cacheUserService->deleteAllCacheUsers();
                    break;
                case 'Single user//users':
                    $idsString = $this->ask('Введите id пользователей через пробел');
                    $idsArray = explode(" ", $idsString);
                    foreach ($idsArray as $id) {
                        if (Cache::store("memcached")->has($id)) {
                            Cache::store('memcached')->forget($id);
                        }
                    }
                    break;
                case 'Categories':
                    Cache::store('memcached')->forget('categories');
                    break;
                case 'All':
                    Cache::store('memcached')->forget('categories');
                    $this->cacheUserService->deleteAllCacheUsers();
                    break;
            }
            $this->line('Кеш очищен ');
        } else {
            $email = $this->ask('Введите емейл пользователя, у которого хотите удалить кеш');
            $id = User::where('email', $email)->first()->id;
            if (Cache::store('memcached')->has($id)) {
                Cache::store('memcached')->forget($id);
                $this->line('Удален кеш пользователя id ' . $id);
            }
        }
    }
}
