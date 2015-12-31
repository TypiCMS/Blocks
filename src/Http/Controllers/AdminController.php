<?php

namespace TypiCMS\Modules\Blocks\Http\Controllers;

use TypiCMS\Modules\Blocks\Http\Requests\FormRequest;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Blocks\Repositories\BlockInterface;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function __construct(BlockInterface $block)
    {
        parent::__construct($block);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('core::admin.create')
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
        return view('core::admin.edit')
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
        $this->repository->update($request->all());

        return $this->redirect($request, $block);
    }
}
