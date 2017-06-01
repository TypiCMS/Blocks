<?php

namespace TypiCMS\Modules\Blocks\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('see-all-blocks')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Content blocks'), function (SidebarItem $item) {
                $item->id = 'blocks';
                $item->icon = config('typicms.blocks.sidebar.icon', 'icon fa fa-fw fa-list-alt');
                $item->weight = config('typicms.blocks.sidebar.weight');
                $item->route('admin::index-blocks');
                $item->append('admin::create-block');
            });
        });
    }
}
