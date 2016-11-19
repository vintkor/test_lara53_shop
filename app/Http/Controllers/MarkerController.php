<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MarkerController extends Controller
{
    public function add_marker(Request $request)
    {
    	$content = '<div id="content"><div id="siteNotice"></div><h1 id="firstHeading" class="firstHeading">Заголовок</h1><div id="bodyContent"><p><i class="fa fa-phone" aria-hidden="true"></i> '
    		. $request->string_1
    		. '</p><p><i class="fa fa-phone" aria-hidden="true"></i> '
    		. $request->string_2
    		. '</p><p><i class="fa fa-phone" aria-hidden="true"></i> '
    		. $request->string_3
    		. '</p></div></div>';

    	switch ($request->icon) {
    		case 'red':
    			$icon = '/images/map.png';
    			break;
    		case 'blue':
    			$icon = '/images/new-map.png';
    			break;    		
    		default:
    			$icon = '/images/map.png';
    			break;
    	}

    	DB::table('markers')->insert([
    		'title' => $request->title,
    		'lat' => $request->lat,
    		'lng' => $request->lng,
    		'city' => $request->city,
    		'inner_title' => $request->inner_title,
    		'icon' => $icon,
    		'content' => $content
    	]);

    	return redirect()->route('home');
    }
}
