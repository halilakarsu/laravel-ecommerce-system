<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Slogans;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SlogansController extends Controller
{
    public function index()
    { $slogans=Slogans::all()->sortBy('slogan_sort');
        return view('backend.slogans.index',compact('slogans'));
    }
    public function create()
    {
        return view('backend.slogans.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $slogans = Slogans::find(intval($value));
            $slogans->slogan_sort=intval($key);
            $slogans->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('slogan_imagepath')){
            $request->validate([
                'slogan_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'slogan_title'=>'required',
                'slogan_description'=>'required',
                'slogan_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->slogan_imagepath->getClientOriginalName();
            $request->slogan_imagepath->move(public_path('backend/images/slogans/'),$fileName);
            if($request->slogan_slug>3){
                $sloganSlug=Str::slug($request->slogan_slug);
            }else {
                $sloganSlug=Str::slug($request->slogan_title);
            }
            $slogansStore=new Slogans();
            $slogansStore->slogan_title=$request->slogan_title;
            $slogansStore->slogan_description=$request->slogan_description;
            $slogansStore->slogan_status=$request->slogan_status;
            $slogansStore->slogan_slug=$sloganSlug;
            $slogansStore->slogan_imagepath=$fileName;
            $slogansStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($slogansStore) {
            return redirect(route('slogans.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Slogans $slogans)
    {
        //
    }

    public function edit($id)
    {
        $slogansEdit=Slogans::where('id',$id)->first();
        return view('backend.slogans.edit',compact('slogansEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->slogan_slug>3){
        $sloganSlug=Str::slug($request->slogan_slug);
    }else {
        $sloganSlug=Str::slug($request->slogan_title);
    }
        if($request->hasFile('slogan_imagepath')){
            $request->validate([
                'slogan_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'slogan_title'=>'required',
                'slogan_description'=>'required',
                'slogan_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->slogan_imagepath->getClientOriginalName();
            $request->slogan_imagepath->move(public_path('backend/images/slogans/'),$fileName);

            $slogansUpdate=Slogans::where('id',$id)->update([
                'slogan_imagepath'=>$fileName,
                'slogan_title'=>$request->slogan_title,
                'slogan_slug'=>$sloganSlug,
                'slogan_description'=>$request->slogan_description,
                'slogan_status'=>$request->slogan_status

            ]);
            $path='backend/images/slogans/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'slogan_title'=>'required',
                'slogan_description'=>'required',
                'slogan_status'=>'required'
            ]);
            $slogansUpdate=Slogans::where('id',$id)->update([
                'slogan_title'=>$request->slogan_title,
                'slogan_slug'=>$sloganSlug,
                'slogan_description'=>$request->slogan_description,
                'slogan_status'=>$request->slogan_status,
            ]);
        }


        if($slogansUpdate){
            return redirect(route('slogans.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $sloganDelete = Slogans::find(intval($id));
        if ($sloganDelete) {
            $oldFile=$sloganDelete->slogan_imagepath;
            if($oldFile && file_exists(public_path('backend/images/slogans/'.$oldFile))) {
                unlink(public_path('backend/images/slogans/' . $oldFile));
            }
            $sloganDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Slogans::where('id', intval($id))->update([
            'slogan_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
