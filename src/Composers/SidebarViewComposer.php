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
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('blocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.blocks.sidebar.icon', 'icon fa fa-fw fa-list-alt');
                $item->weight = config('typicms.blocks.sidebar.weight');
                $item->route('admin::index-blocks');
                $item->append('admin::create-blocks');
                $item->authorize(
                    Gate::allows('index-blocks')
                );
            });
        });
    }
}
