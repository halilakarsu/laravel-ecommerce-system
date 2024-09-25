<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PagesControler extends Controller
{
    public function index()
    { $pages=Pages::all()->sortBy('page_sort');
        return view('backend.pages.index',compact('pages'));
    }
    public function create()
    {
        return view('backend.pages.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $pages = Pages::find(intval($value));
            $pages->page_sort=intval($key);
            $pages->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('page_imagepath')){
            $request->validate([
                'page_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'page_title'=>'required',
                'page_description'=>'required',
                'page_title1'=>'required',
                'page_title2'=>'required',

            ]);
            $fileName=rand(1,99999).''.$request->page_imagepath->getClientOriginalName();
            $request->page_imagepath->move(public_path('backend/images/pages/'),$fileName);
            if($request->page_slug>3){
                $pageSlug=Str::slug($request->page_slug);
            }else {
                $pageSlug=Str::slug($request->page_title);
            }
            $pagesStore=new Pages();
            $pagesStore->page_title=$request->page_title;
            $pagesStore->page_description=$request->page_description;
            $pagesStore->page_title1=$request->page_title1;
            $pagesStore->page_title2=$request->page_title2;
            $pagesStore->page_slug=$pageSlug;
            $pagesStore->page_imagepath=$fileName;
            $pagesStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($pagesStore) {
            return redirect(route('pages.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Pages $pages)
    {
        //
    }

    public function edit($id)
    {
        $pagesEdit=Pages::where('id',$id)->first();
        return view('backend.pages.edit',compact('pagesEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->page_slug>3){
        $pageSlug=Str::slug($request->page_slug);
    }else {
        $pageSlug=Str::slug($request->page_title);
    }
        if($request->hasFile('page_imagepath')){
            $request->validate([
                'page_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'page_title'=>'required',
                'page_description'=>'required',
                    ]);
            $fileName=rand(1,99999).'-'.$request->page_imagepath->getClientOriginalName();
            $request->page_imagepath->move(public_path('backend/images/pages/'),$fileName);

            $pagesUpdate=Pages::where('id',$id)->update([
                'page_imagepath'=>$fileName,
                'page_title'=>$request->page_title,
                'page_slug'=>$pageSlug,
                'page_description'=>$request->page_description,
                'page_title1'=>$request->page_title1,
                 'page_title2'=>$request->page_title2,

            ]);
            $path='backend/images/pages/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'page_title'=>'required',
                'page_description'=>'required',
                    ]);
            $pagesUpdate=Pages::where('id',$id)->update([
                'page_title'=>$request->page_title,
                'page_slug'=>$pageSlug,
                'page_description'=>$request->page_description,
                'page_title1'=>$request->page_title1,
                'page_title2'=>$request->page_title2

            ]);
        }


        if($pagesUpdate){
            return redirect(route('pages.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $pageDelete = Pages::find(intval($id));
        if ($pageDelete) {
            $oldFile=$pageDelete->page_imagepath;
            if($oldFile && file_exists(public_path('backend/images/pages/'.$oldFile))) {
                unlink(public_path('backend/images/pages/' . $oldFile));
            }
            $pageDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Pages::where('id', intval($id))->update([
            'page_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
