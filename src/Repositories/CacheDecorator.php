<?php

namespace TypiCMS\Modules\Blocks\Repositories;

use Illuminate\Database\Eloquent\Collection;
use TypiCMS\Modules\Core\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements BlockInterface
{
    public function __construct(BlockInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * Get all models.
     *
     * @param bool  $all  Show published or all
     * @param array $with Eager load related models
     *
     * @return Collection
     */
    public function all(array $with = [], $all = false)
    {
        $cacheKey = md5(config('app.locale').'all'.$all.serialize($with));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->all($with, $all);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }

    /**
     * Get the content of a block.
     *
     * @param string $name unique name of the block
     * @param array  $with linked
     *
     * @return string html
     */
    public function render($name = null, array $with = ['translations'])
    {
        $cacheKey = md5(config('app.locale').'render'.$name.serialize($with));

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $model = $this->repo->render($name, $with);

        // Store in cache for next request
        $this->cache->put($cacheKey, $model);

        return $model;
    }
}
