<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Settings;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Menu;
class HomeController extends Controller
{
    public function index(){
         $sliders=Sliders::all()->sortBy('slider_sort');
        $social=Social::all()->sortBy('social_sort');
         $menuUst=Menu::where('menu_ust',0)->get()->sortBy('menu_sort');
         $menuAlt=Menu::where('menu_ust','>',0)->get()->sortBy('menu_sort');
         return view('frontend.home.index',compact('sliders','menuUst','menuAlt','social'));
    }
    public function blog(){
        $blog=Blogs::all()->sortBy('slider_sort');
        $social=Social::all()->sortBy('social_sort');
        $menuUst=Menu::where('menu_ust',0)->get()->sortBy('menu_sort');
        $menuAlt=Menu::where('menu_ust','>',0)->get()->sortBy('menu_sort');
        return view('frontend.home.blog',compact('blog','menuUst','menuAlt','social'));
    }

}
