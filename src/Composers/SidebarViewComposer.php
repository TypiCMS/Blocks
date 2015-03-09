<?php
namespace TypiCMS\Modules\Blocks\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('blocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.blocks.sidebar.icon', 'icon fa fa-fw fa-list-alt');
                $item->weight = config('typicms.blocks.sidebar.weight');
                $item->route('admin.blocks.index');
                $item->append('admin.blocks.create');
                $item->authorize(
                    $this->auth->hasAccess('blocks.index')
                );
            });
        });
    }
}
