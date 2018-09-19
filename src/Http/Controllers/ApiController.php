<?php

namespace TypiCMS\Modules\Blocks\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Blocks\Repositories\EloquentBlock;

class ApiController extends BaseApiController
{
    public function __construct(EloquentBlock $block)
    {
        parent::__construct($block);
    }

    public function index(Request $request)
    {
        $models = QueryBuilder::for(Block::class)
            ->translated($request->input('translatable_fields'))
            ->paginate($request->input('per_page'));

        return $models;
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
            $block->$key = $value;
        }
        $saved = $block->save();

        $this->repository->forgetCache();

        return response()->json([
            'error' => !$saved,
        ]);
    }

    public function destroy(Block $block)
    {
        $deleted = $this->repository->delete($block);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
