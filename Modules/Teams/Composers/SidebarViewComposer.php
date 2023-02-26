<?php

namespace TypiCMS\Modules\Teams\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('see-all-teams')) {
            return;
        }
        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Teams'), function (SidebarItem $item) {
                $item->id = 'teams';
                $item->icon = config('typicms.teams.sidebar.icon', 'icon fa fa-fw fa-image');
                $item->weight = config('typicms.teams.sidebar.weight');
                $item->route('admin::index-teams');
                $item->append('admin::create-team');
            });
        });
    }
}
