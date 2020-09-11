<?php

namespace TypiCMS\Modules\Blocks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Block::class)
            ->selectFields($request->input('fields.blocks'))
            ->allowedSorts(['status_translated', 'name', 'body_translated'])
            ->allowedFilters([
                AllowedFilter::custom('name,body', new FilterOr()),
            ])
            ->paginate($request->input('per_page'));

        $data->setCollection(
            collect($data->items())
                ->map(
                    function ($item) {
                        $item->body_translated = trim(strip_tags(html_entity_decode($item->body_translated)), '"');

                        return $item;
                    }
                )
        );

        return $data;
    }

    protected function updatePartial(Block $block, Request $request)
    {
        $data = [];
        foreach ($request->all() as $column => $content) {
            if (is_array($content)) {
                foreach ($content as $key => $value) {
                    $data[$column.'->'.$key] = $value;
                }
            } else {
                $data[$column] = $content;
            }
        }

        foreach ($data as $key => $value) {
            $block->{$key} = $value;
        }
        $block->save();
    }

    public function destroy(Block $block)
    {
        $block->delete();
    }
}
