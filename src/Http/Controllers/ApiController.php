<?php
namespace TypiCMS\Modules\Blocks\Http\Controllers;

use Illuminate\Support\Facades\Input;
use TypiCMS\Modules\Blocks\Repositories\BlockInterface as Repository;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Model|false
     */
    public function store()
    {
        $model = $this->repository->create(Input::all());
        $error = $model ? false : true ;
        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @return boolean
     */
    public function update($model)
    {
        $error = $this->repository->update(Input::all()) ? false : true ;
        return response()->json([
            'error' => $error,
        ], 200);
    }
}
