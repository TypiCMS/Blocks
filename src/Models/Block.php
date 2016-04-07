<?php

namespace TypiCMS\Modules\Blocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Block extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Blocks\Presenters\BlockPresenter';

    protected $fillable = [
        'name',
        // Translatable columns
        'status',
        'body',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'status',
        'body',
    ];

    protected $appends = ['status', 'body_cleaned'];

    /**
     * Append status attribute from translation table.
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return $this->status;
    }

    /**
     * Append title attribute from translation table.
     *
     * @return string title
     */
    public function getTitleAttribute($value)
    {
        return $this->title;
    }

    /**
     * Append thumb attribute.
     *
     * @return string
     */
    public function getThumbAttribute($value)
    {
        return $this->present()->thumbSrc(null, 22);
    }

    /**
     * Append Body attribute from translation table.
     *
     * @return string
     */
    public function getBodyCleanedAttribute()
    {
        return strip_tags(html_entity_decode($this->body));
    }
}
