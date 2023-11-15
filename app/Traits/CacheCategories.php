<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

trait CacheCategories
{
    public function createAndReturnCacheCategories(Collection $categories): array| Collection
    {
        $cacheCategories = Cache::store('memcached')->remember('categories', 60 * 60 * 24, function () use ($categories) {
            return $categories;
        });
        return $cacheCategories;
    }
}
