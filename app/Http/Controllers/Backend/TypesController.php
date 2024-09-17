<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TypesController extends Controller
{
    public function index()
    { $types=Types::all()->sortBy('type_sort');
        return view('backend.types.index',compact('types'));
    }
    public function create()
    {
        return view('backend.types.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $types = Types::find(intval($value));
            $types->type_sort=intval($key);
            $types->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('type_imagepath')){
            $request->validate([
                'type_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'type_title'=>'required',
                'type_description'=>'required',
                'type_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->type_imagepath->getClientOriginalName();
            $request->type_imagepath->move(public_path('backend/images/types/'),$fileName);
            if($request->type_slug>3){
                $typeSlug=Str::slug($request->type_slug);
            }else {
                $typeSlug=Str::slug($request->type_title);
            }
            $typesStore=new Types();
            $typesStore->type_title=$request->type_title;
            $typesStore->type_description=$request->type_description;
            $typesStore->type_status=$request->type_status;
            $typesStore->type_slug=$typeSlug;
            $typesStore->type_imagepath=$fileName;
            $typesStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($typesStore) {
            return redirect(route('types.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Types $types)
    {
        //
    }

    public function edit($id)
    {
        $typesEdit=Types::where('id',$id)->first();
        return view('backend.types.edit',compact('typesEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->type_slug>3){
        $typeSlug=Str::slug($request->type_slug);
    }else {
        $typeSlug=Str::slug($request->type_title);
    }
        if($request->hasFile('type_imagepath')){
            $request->validate([
                'type_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'type_title'=>'required',
                'type_description'=>'required',
                'type_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->type_imagepath->getClientOriginalName();
            $request->type_imagepath->move(public_path('backend/images/types/'),$fileName);

            $typesUpdate=Types::where('id',$id)->update([
                'type_imagepath'=>$fileName,
                'type_title'=>$request->type_title,
                'type_slug'=>$typeSlug,
                'type_description'=>$request->type_description,
                'type_status'=>$request->type_status

            ]);
            $path='backend/images/types/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'type_title'=>'required',
                'type_description'=>'required',
                'type_status'=>'required'
            ]);
            $typesUpdate=Types::where('id',$id)->update([
                'type_title'=>$request->type_title,
                'type_slug'=>$typeSlug,
                'type_description'=>$request->type_description,
                'type_status'=>$request->type_status,
            ]);
        }


        if($typesUpdate){
            return redirect(route('types.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $typeDelete = Types::find(intval($id));
        if ($typeDelete) {
            $oldFile=$typeDelete->type_imagepath;
            if($oldFile && file_exists(public_path('backend/images/types/'.$oldFile))) {
                unlink(public_path('backend/images/types/' . $oldFile));
            }
            $typeDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Types::where('id', intval($id))->update([
            'type_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
