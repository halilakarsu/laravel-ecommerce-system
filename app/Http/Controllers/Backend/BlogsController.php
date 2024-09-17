<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BlogsController extends Controller
{
     public function index()
    { $blogs=Blogs::all()->sortBy('blog_sort');
        return view('backend.blogs.index',compact('blogs'));
    }
    public function create()
    {
        return view('backend.blogs.create');
    }
    public function sortable()
    {
         //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $blogs = Blogs::find(intval($value));
            $blogs->blog_sort=intval($key);
            $blogs->save();
      }
        echo true;
    }
    public function store(Request $request)
    {
         if($request->hasFile('blog_imagepath')){
              $request->validate([
                'blog_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
              ]);
              $fileName=rand(1,99999).''.$request->blog_imagepath->getClientOriginalName();
              $request->blog_imagepath->move(public_path('backend/images/blogs/'),$fileName);
             if($request->blog_slug>3){
                 $blogSlug=Str::slug($request->blog_slug);
             }else {
                 $blogSlug=Str::slug($request->blog_title);
             }
              $blogsStore=new Blogs();
              $blogsStore->blog_title=$request->blog_title;
              $blogsStore->blog_description=$request->blog_description;
              $blogsStore->blog_status=$request->blog_status;
              $blogsStore->blog_slug=$blogSlug;
              $blogsStore->blog_imagepath=$fileName;
              $blogsStore->save();

          }else{
              return back()->with('error','Sanırım bir hata oluştu');
          }
         if($blogsStore) {
             return redirect(route('blogs.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }else {
             return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }
    }


    public function show(Blogs $blogs)
    {
        //
    }

    public function edit($id)
    {
        $blogsEdit=Blogs::where('id',$id)->first();
        return view('backend.blogs.edit',compact('blogsEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->blog_slug>3){
        $blogSlug=Str::slug($request->blog_slug);
    }else {
        $blogSlug=Str::slug($request->blog_title);
    }
        if($request->hasFile('blog_imagepath')){
            $request->validate([
                'blog_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->blog_imagepath->getClientOriginalName();
            $request->blog_imagepath->move(public_path('backend/images/blogs/'),$fileName);

            $blogsUpdate=Blogs::where('id',$id)->update([
                'blog_imagepath'=>$fileName,
                'blog_title'=>$request->blog_title,
                 'blog_slug'=>$blogSlug,
                'blog_description'=>$request->blog_description,
                'blog_status'=>$request->blog_status

            ]);
            $path='backend/images/blogs/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
            ]);
            $blogsUpdate=Blogs::where('id',$id)->update([
                'blog_title'=>$request->blog_title,
                'blog_slug'=>$blogSlug,
                'blog_description'=>$request->blog_description,
                'blog_status'=>$request->blog_status,
               ]);
        }


        if($blogsUpdate){
            return redirect(route('blogs.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $blogDelete = Blogs::find(intval($id));
        if ($blogDelete) {
            $oldFile=$blogDelete->blog_imagepath;
            if($oldFile && file_exists(public_path('backend/images/blogs/'.$oldFile))) {
                unlink(public_path('backend/images/blogs/' . $oldFile));
            }
            $blogDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Blogs::where('id', intval($id))->update([
            'blog_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
