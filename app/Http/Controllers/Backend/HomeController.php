<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Dropzone;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(){
        return view("backend.home.index");
  }
}
