<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class CacheUserService
{
    public function createCacheUsers(Collection $users)
    {

        foreach ($users as $userLoop) {
            $ids[] = $userLoop->id;
            Cache::store('memcached')->put($userLoop->id, $userLoop, env('CACHE_USERS_LiFETIME'));
        }
        Cache::store('memcached')->put('userKeys', $ids, env('CACHE_USERS_LiFETIME'));
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

    public function deleteAllCacheUsers()
    {
        if (Cache::store('memcached')->has('userKeys')) {
            $userKeys = Cache::store('memcached')->get('userKeys');
            foreach ($userKeys as $userKey) {
                Cache::store('memcached')->forget($userKey);
            }
            Cache::store('memcached')->forget('userKeys');
        }
    }
}
