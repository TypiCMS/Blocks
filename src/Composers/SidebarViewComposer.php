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
        $view->sidebar->group(__('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(__('blocks::global.name'), function (SidebarItem $item) {
                $item->id = 'blocks';
                $item->icon = config('typicms.blocks.sidebar.icon', 'icon fa fa-fw fa-list-alt');
                $item->weight = config('typicms.blocks.sidebar.weight');
                $item->route('admin::index-blocks');
                $item->append('admin::create-block');
                $item->authorize(
                    Gate::allows('index-blocks')
                );
            });
        });
    }
}
