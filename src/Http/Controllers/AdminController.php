<?php

namespace TypiCMS\Modules\Blocks\Http\Controllers;

use TypiCMS\Modules\Blocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Blocks\Repositories\EloquentBlock;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function __construct(EloquentBlock $block)
    {
        parent::__construct($block);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->findAll();
        app('JavaScript')->put('models', $models);

        return view('blocks::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->createModel();

        return view('blocks::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Blocks\Models\Block $block
     *
     * @return \Illuminate\View\View
     */
    public function edit(Block $block)
    {
        return view('blocks::admin.edit')
            ->with(['model' => $block]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Blocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $block = $this->repository->create($request->all());

        return $this->redirect($request, $block);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Blocks\Models\Block              $block
     * @param \TypiCMS\Modules\Blocks\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Block $block, FormRequest $request)
    {
        $this->repository->update($request->id, $request->all());

        return $this->redirect($request, $block);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Blocks\Models\Block $block
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Block $block)
    {
        $deleted = $this->repository->delete($block);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
