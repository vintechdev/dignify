<?php

namespace TypiCMS\Modules\Products\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('see-all-products')) {
            return;
        }

        $view->sidebar->group(__('Content'), function (SidebarGroup $group) {
            $group->id = 'content';
            $group->weight = 30;
            $group->addItem(__('Products'), function (SidebarItem $item) {
                $item->id = 'products';
                $item->icon = config('typicms.products.sidebar.icon', 'icon fa fa-fw fa-cube');
                $item->weight = config('typicms.products.sidebar.weight');
                $item->route('admin::index-products');
                $item->append('admin::create-product');
            });

            $group->addItem(__('Brochures'), function (SidebarItem $item) {
                $item->id = 'brochures';
                $item->icon = 'icon fa fa-fw fa-file';
                $item->weight = 1;
                $item->route('admin::index-brochures');
                $item->append('admin::create-brochures');
            });
        });
    }
}
