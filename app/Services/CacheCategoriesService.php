<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class CacheCategoriesService
{
    public function createAndReturnCacheCategories(Collection $categories): array| Collection
    {
        $cacheCategories = Cache::store('memcached')->remember('categories', env('CACHE_CATEGORIES_LiFETIME'), function () use ($categories) {
            return $categories;
        });
        return $cacheCategories;
    }
}
