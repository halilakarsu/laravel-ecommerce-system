<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    public function index()
    { $categories=Categories::all()->sortBy('categori_sort');
        return view('backend.categories.index',compact('categories'));
    }
    public function create()
    {
        return view('backend.categories.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $categories = Categories::find(intval($value));
            $categories->categori_sort=intval($key);
            $categories->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('categori_imagepath')){
            $request->validate([
                'categori_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'categori_title'=>'required',
                'categori_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->categori_imagepath->getClientOriginalName();
            $request->categori_imagepath->move(public_path('backend/images/categories/'),$fileName);
            if($request->categori_slug>3){
                $categoriSlug=Str::slug($request->categori_slug);
            }else {
                $categoriSlug=Str::slug($request->categori_title);
            }
            $categoriesStore=new Categories();
            $categoriesStore->categori_title=$request->categori_title;
           $categoriesStore->categori_status=$request->categori_status;
            $categoriesStore->categori_slug=$categoriSlug;
            $categoriesStore->categori_imagepath=$fileName;
            $categoriesStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($categoriesStore) {
            return redirect(route('categories.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }

    public function edit($id)
    {
        $categoriesEdit=Categories::where('id',$id)->first();
        return view('backend.categories.edit',compact('categoriesEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->categori_slug>3){
        $categoriSlug=Str::slug($request->categori_slug);
    }else {
        $categoriSlug=Str::slug($request->categori_title);
    }
        if($request->hasFile('categori_imagepath')){
            $request->validate([
                'categori_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'categori_title'=>'required',
                'categori_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->categori_imagepath->getClientOriginalName();
            $request->categori_imagepath->move(public_path('backend/images/categories/'),$fileName);
            $categoriesUpdate=Categories::where('id',$id)->update([
                'categori_imagepath'=>$fileName,
                'categori_title'=>$request->categori_title,
                'categori_slug'=>$categoriSlug,
                'categori_status'=>$request->categori_status

            ]);
            $path='backend/images/categories/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'categori_title'=>'required',
                'categori_status'=>'required'
            ]);
            $categoriesUpdate=Categories::where('id',$id)->update([
                'categori_title'=>$request->categori_title,
                'categori_slug'=>$categoriSlug,
                'categori_status'=>$request->categori_status,
            ]);
        }
        if($categoriesUpdate){
            return redirect(route('categories.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $categoriDelete = Categories::find(intval($id));
        if ($categoriDelete) {
            $oldFile=$categoriDelete->categori_imagepath;
            if($oldFile && file_exists(public_path('backend/images/categories/'.$oldFile))) {
                unlink(public_path('backend/images/categories/' . $oldFile));
            }
            $categoriDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
    public function switch(Request $request, $id){
        $switchStatus = Categories::where('id', intval($id))->update([
            'categori_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);
        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
