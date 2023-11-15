<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

trait CacheUser
{
    public function createCacheUsers(Collection $users)
    {

        foreach ($users as $userLoop) {
            $id = $userLoop->id;
            $ids[] = $id;
            Cache::store('memcached')->put($id, $userLoop, now()->addMinutes(100));
        }
        Cache::store('memcached')->put('userKeys', $ids, now()->addMinutes(100));
    }

    public function returnCacheUsersArray()
    {
        if (Cache::store('memcached')->has('userKeys')) {
            $userKeys = Cache::store('memcached')->get('userKeys');
            for ($i = 0; $i < count($userKeys); $i++) {
                $resultUsers[] = Cache::store('memcached')->get($userKeys[$i]);
            }
        }
        return $resultUsers;
    }
}
