<?php

namespace TypiCMS\Modules\Blocks\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Core\Repositories\EloquentRepository;

class EloquentBlock extends EloquentRepository
{
    protected $repositoryId = 'blocks';

    protected $model = Block::class;

    /**
     * Get the content of a block.
     *
     * @param string $name unique name of the block
     * @param array  $with linked
     *
     * @return string html
     */
    public function render($name = null)
    {
        $block = $this->where('name', $name)
            ->where(column('status'), '1')
            ->first();

        if ($block) {
            return $block->present()->body;
        }

    }
}
