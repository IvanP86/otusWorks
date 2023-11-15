<?php

namespace App\Console\Commands;

use App\Traits\CacheUser;
use Illuminate\Console\Command;
use App\Models\User;

class MakeUsersCache extends Command
{
    use CacheUser;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'makeUsersCache';

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
        $this->createCacheUsers(User::all());
        $this->line('Создан кеш userKeys и кеш по отдельным пользователям');
    }
}
