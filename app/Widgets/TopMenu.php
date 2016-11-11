<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use DB;

class TopMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $menus = DB::table('TopMenu')->where('active', 1)->orderBy('position', 'asc')->get();

        return view("widgets.top_menu", [
            'config' => $this->config,
            'menus'  => $menus
        ]);
    }
}