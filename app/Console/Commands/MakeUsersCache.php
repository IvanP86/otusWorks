<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\CacheUserService;
use Illuminate\Support\Facades\Cache;

class MakeUsersCache extends Command
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
    protected $signature = 'app:cache:make
                             {users?* : array id\'s users}
                                {--all : option for all users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаем кеш всех юзеров';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersIds = $this->argument('users');

        if ($this->option('all') || count($usersIds) == 0) {
            $this->cacheUserService->createCacheUsers(User::all());
            $this->line('Создан кеш userKeys и кеш по отдельным пользователям');
        } else {
            foreach ($usersIds as $userId) {
                $user = User::query()->where('id', $userId)->get();
                if ($user->isNotEmpty()) {
                    Cache::store('memcached')->forget($userId);
                    Cache::store('memcached')->put($userId, $user);
                    $this->info('Создан кеш для пользователя id' . $userId);
                }
            }
        }
    }
}
