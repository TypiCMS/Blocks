<?php
namespace TypiCMS\Modules\Blocks\Http\Controllers;

use TypiCMS\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Blocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Blocks\Repositories\BlockInterface;

class AdminController extends BaseAdminController
{

    public function __construct(BlockInterface $block)
    {
        parent::__construct($block);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->all());
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($model, FormRequest $request)
    {
        $this->repository->update($request->all());
        return $this->redirect($request, $model);
    }
}
