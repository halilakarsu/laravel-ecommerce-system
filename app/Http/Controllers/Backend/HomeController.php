<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Dropzone;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(){
        //not downloaded files deleted
        $images = Dropzone::whereNull('product_id');
        $images->delete();
        $files = File::files(public_path('backend/images/products/dropzone'));
        File::delete($files);
        return view("backend.home.index");
  }
}
