<?php

namespace TypiCMS\Modules\Blocks\Models;

use TypiCMS\Modules\Core\Models\BaseTranslation;

class BlockTranslation extends BaseTranslation
{
    protected $fillable = [
        'status',
        'body',
    ];

    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Blocks\Models\Block', 'block_id');
    }
}
