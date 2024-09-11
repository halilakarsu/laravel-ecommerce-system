<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $blogsCreate=Blogs::all();
        return view('backend.blogs.index',compact('blogsCreate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $blogsStore=new Blogs();
          $blogsStore->blog_title=$request->blog_title;
          $blogsStore->blog_sort=$request->blog_sort;
          $blogsStore->blog_description=$request->blog_description;
          $blogsStore->blog_status=$request->blog_status;
          $blogsStore->blog_imagepath=$request->blog_imagepath;
          $blogsStore->blog_slug=$request->blog_slug;
          $blogsStore->save();
         if($blogsStore) {
             return redirect()->route('blogs.index')->with('success',"Kayıt İşlemi başarılı");
         }else {
             return back()->with('error',"Kayıt İşlemi Başarısız");
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blogsEdit=Blogs::where('id',$id)->first();
        return view('backend.blogs.edit',compact('blogsEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blogsUpdate=Blogs::where('id',$id)->update([
          'blog_title'=>$request->blog_title,
          'blog_slug'=>$request->blog_slug,
          'blog_sort'=>$request->blog_sort,
          'blog_description'=>$request->blog_description,
          'blog_status'=>$request->blog_status,
          'blog_imagepath'=>$request->blog_imagepath
        ]);
        if($blogsUpdate){
         return redirect()->route('blogs.index')->with("success","Güncelleme İşlemi Başarılı");
        }else {
            return back()->with("error","Güncelleme işlemi Başarısız");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blogs)
    {
        //
    }
}
