<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class FilesController extends Controller
{
    public function index()
    { $filess=Files::all()->sortBy('files_sort');
        return view('backend.filess.index',compact('filess'));
    }
    public function create()
    {
        return view('backend.filess.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $filess = Files::find(intval($value));
            $filess->files_sort=intval($key);
            $filess->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('files_imagepath')){
            $request->validate([
                'files_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'files_title'=>'required',
                'files_description'=>'required',
                'files_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->files_imagepath->getClientOriginalName();
            $request->files_imagepath->move(public_path('backend/images/filess/'),$fileName);
            if($request->files_slug>3){
                $filesSlug=Str::slug($request->files_slug);
            }else {
                $filesSlug=Str::slug($request->files_title);
            }
            $filessStore=new Files();
            $filessStore->files_title=$request->files_title;
            $filessStore->files_description=$request->files_description;
            $filessStore->files_status=$request->files_status;
            $filessStore->files_slug=$filesSlug;
            $filessStore->files_imagepath=$fileName;
            $filessStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($filessStore) {
            return redirect(route('filess.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Files $filess)
    {
        //
    }

    public function edit($id)
    {
        $filessEdit=Files::where('id',$id)->first();
        return view('backend.filess.edit',compact('filessEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->files_slug>3){
        $filesSlug=Str::slug($request->files_slug);
    }else {
        $filesSlug=Str::slug($request->files_title);
    }
        if($request->hasFile('files_imagepath')){
            $request->validate([
                'files_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'files_title'=>'required',
                'files_description'=>'required',
                'files_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->files_imagepath->getClientOriginalName();
            $request->files_imagepath->move(public_path('backend/images/filess/'),$fileName);

            $filessUpdate=Files::where('id',$id)->update([
                'files_imagepath'=>$fileName,
                'files_title'=>$request->files_title,
                'files_slug'=>$filesSlug,
                'files_description'=>$request->files_description,
                'files_status'=>$request->files_status

            ]);
            $path='backend/images/filess/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'files_title'=>'required',
                'files_description'=>'required',
                'files_status'=>'required'
            ]);
            $filessUpdate=Files::where('id',$id)->update([
                'files_title'=>$request->files_title,
                'files_slug'=>$filesSlug,
                'files_description'=>$request->files_description,
                'files_status'=>$request->files_status,
            ]);
        }


        if($filessUpdate){
            return redirect(route('filess.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $filesDelete = Files::find(intval($id));
        if ($filesDelete) {
            $oldFile=$filesDelete->files_imagepath;
            if($oldFile && file_exists(public_path('backend/images/filess/'.$oldFile))) {
                unlink(public_path('backend/images/filess/' . $oldFile));
            }
            $filesDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Files::where('id', intval($id))->update([
            'files_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
