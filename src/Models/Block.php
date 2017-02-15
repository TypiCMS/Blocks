<?php

namespace TypiCMS\Modules\Blocks\Models;

use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Block extends Base
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Blocks\Presenters\BlockPresenter';

    protected $guarded = ['id', 'exit'];

    public $translatable = [
        'status',
        'body',
    ];

    protected $appends = ['body_cleaned_translated'];

    /**
     * Append thumb attribute.
     *
     * @return string
     */
    public function getThumbAttribute()
    {
        return $this->present()->thumbSrc(null, 22);
    }

    /**
     * Append body_cleaned_translated attribute.
     *
     * @return string
     */
    public function getBodyCleanedTranslatedAttribute()
    {
        $locale = config('app.locale');
        $body = $this->translate('body', config('typicms.content_locale', $locale));
        return trim(strip_tags(html_entity_decode($body)), '"');
    }
}
