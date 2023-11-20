<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\CacheUserService;

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
    protected $signature = 'app:cache:make';

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
        $this->cacheUserService->createCacheUsers(User::all());
        $this->line('Создан кеш userKeys и кеш по отдельным пользователям');
    }
}
