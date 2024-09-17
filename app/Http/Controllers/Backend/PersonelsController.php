<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Personels;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PersonelsController extends Controller
{
    public function index()
    { $personels=Personels::all()->sortBy('personel_sort');
        return view('backend.personels.index',compact('personels'));
    }
    public function create()
    {
        return view('backend.personels.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $personels = Personels::find(intval($value));
            $personels->personel_sort=intval($key);
            $personels->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('personel_imagepath')){
            $request->validate([
                'personel_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'personel_title'=>'required',
                'personel_description'=>'required',
                'personel_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->personel_imagepath->getClientOriginalName();
            $request->personel_imagepath->move(public_path('backend/images/personels/'),$fileName);
            if($request->personel_slug>3){
                $personelSlug=Str::slug($request->personel_slug);
            }else {
                $personelSlug=Str::slug($request->personel_title);
            }
            $personelsStore=new Personels();
            $personelsStore->personel_title=$request->personel_title;
            $personelsStore->personel_description=$request->personel_description;
            $personelsStore->personel_status=$request->personel_status;
            $personelsStore->personel_slug=$personelSlug;
            $personelsStore->personel_imagepath=$fileName;
            $personelsStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($personelsStore) {
            return redirect(route('personels.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Personels $personels)
    {
        //
    }

    public function edit($id)
    {
        $personelsEdit=Personels::where('id',$id)->first();
        return view('backend.personels.edit',compact('personelsEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->personel_slug>3){
        $personelSlug=Str::slug($request->personel_slug);
    }else {
        $personelSlug=Str::slug($request->personel_title);
    }
        if($request->hasFile('personel_imagepath')){
            $request->validate([
                'personel_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'personel_title'=>'required',
                'personel_description'=>'required',
                'personel_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->personel_imagepath->getClientOriginalName();
            $request->personel_imagepath->move(public_path('backend/images/personels/'),$fileName);

            $personelsUpdate=Personels::where('id',$id)->update([
                'personel_imagepath'=>$fileName,
                'personel_title'=>$request->personel_title,
                'personel_slug'=>$personelSlug,
                'personel_description'=>$request->personel_description,
                'personel_status'=>$request->personel_status

            ]);
            $path='backend/images/personels/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'personel_title'=>'required',
                'personel_description'=>'required',
                'personel_status'=>'required'
            ]);
            $personelsUpdate=Personels::where('id',$id)->update([
                'personel_title'=>$request->personel_title,
                'personel_slug'=>$personelSlug,
                'personel_description'=>$request->personel_description,
                'personel_status'=>$request->personel_status,
            ]);
        }


        if($personelsUpdate){
            return redirect(route('personels.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $personelDelete = Personels::find(intval($id));
        if ($personelDelete) {
            $oldFile=$personelDelete->personel_imagepath;
            if($oldFile && file_exists(public_path('backend/images/personels/'.$oldFile))) {
                unlink(public_path('backend/images/personels/' . $oldFile));
            }
            $personelDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Personels::where('id', intval($id))->update([
            'personel_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
