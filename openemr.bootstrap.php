<?php

use OpenEMR\Menu\MenuEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

function oe_module_npi_registry_add_menu_item(MenuEvent $event)
{
    $menu = $event->getMenu();

    $menuItem = new stdClass();
    $menuItem->requirement = 0;
    $menuItem->target = 'mod';
    $menuItem->menu_id = 'mod0';
    $menuItem->label = xlt("NPI Registry");
    $menuItem->url = "/interface/modules/custom_modules/oe-module-npi-registry/public/index.php";
    $menuItem->children = [];
    /**
     * Access Control List constrain
     * @example 'patients', 'docs', 'admin', 'user', 'demo'
     */
    $menuItem->acl_req = [];

    /**
     * Dinamic constrain based on boolean globals variables
     * It allows a menu item to display if the property is true, and be hidden if the property is false
     */
    $menuItem->global_req = [];

    foreach ($menu as $item) {
        if ($item->menu_id == 'modimg') {
            $item->children[] = $menuItem;
            break;
        }
    }

    $event->setMenu($menu);

    return $event;
}
/**
 * @var EventDispatcherInterface $eventDispatcher
 * @var array                    $module
 * @global                       $eventDispatcher @see ModulesApplication::loadCustomModule
 * @global                       $module          @see ModulesApplication::loadCustomModule
 */
$eventDispatcher->addListener(MenuEvent::MENU_UPDATE, 'oe_module_npi_registry_add_menu_item');
