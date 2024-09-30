<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Menu;
class HomeController extends Controller
{
    public function index(){
         $sliders=Sliders::all()->sortBy('slider_sort');
         $menuUst=Menu::where('menu_ust',0)->get();
         $menuAlt=Menu::where('menu_ust','>',0)->get();
         return view('frontend.home.index',compact('sliders','menuUst','menuAlt'));
    }
}
