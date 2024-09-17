<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SlidersController extends Controller
{
    public function index()
    { $sliders=Slider::all()->sortBy('slider_sort');
        return view('backend.sliders.index',compact('sliders'));
    }
    public function create()
    {
        return view('backend.sliders.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $sliders = Slider::find(intval($value));
            $sliders->slider_sort=intval($key);
            $sliders->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('slider_imagepath')){
            $request->validate([
                'slider_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'slider_title'=>'required',
                'slider_description'=>'required',
                'slider_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->slider_imagepath->getClientOriginalName();
            $request->slider_imagepath->move(public_path('backend/images/sliders/'),$fileName);
            if($request->slider_slug>3){
                $sliderSlug=Str::slug($request->slider_slug);
            }else {
                $sliderSlug=Str::slug($request->slider_title);
            }
            $slidersStore=new Slider();
            $slidersStore->slider_title=$request->slider_title;
            $slidersStore->slider_description=$request->slider_description;
            $slidersStore->slider_status=$request->slider_status;
            $slidersStore->slider_slug=$sliderSlug;
            $slidersStore->slider_imagepath=$fileName;
            $slidersStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($slidersStore) {
            return redirect(route('sliders.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Slider $sliders)
    {
        //
    }

    public function edit($id)
    {
        $slidersEdit=Slider::where('id',$id)->first();
        return view('backend.sliders.edit',compact('slidersEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->slider_slug>3){
        $sliderSlug=Str::slug($request->slider_slug);
    }else {
        $sliderSlug=Str::slug($request->slider_title);
    }
        if($request->hasFile('slider_imagepath')){
            $request->validate([
                'slider_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'slider_title'=>'required',
                'slider_description'=>'required',
                'slider_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->slider_imagepath->getClientOriginalName();
            $request->slider_imagepath->move(public_path('backend/images/sliders/'),$fileName);

            $slidersUpdate=Slider::where('id',$id)->update([
                'slider_imagepath'=>$fileName,
                'slider_title'=>$request->slider_title,
                'slider_slug'=>$sliderSlug,
                'slider_description'=>$request->slider_description,
                'slider_status'=>$request->slider_status

            ]);
            $path='backend/images/sliders/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'slider_title'=>'required',
                'slider_description'=>'required',
                'slider_status'=>'required'
            ]);
            $slidersUpdate=Slider::where('id',$id)->update([
                'slider_title'=>$request->slider_title,
                'slider_slug'=>$sliderSlug,
                'slider_description'=>$request->slider_description,
                'slider_status'=>$request->slider_status,
            ]);
        }


        if($slidersUpdate){
            return redirect(route('sliders.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $sliderDelete = Slider::find(intval($id));
        if ($sliderDelete) {
            $oldFile=$sliderDelete->slider_imagepath;
            if($oldFile && file_exists(public_path('backend/images/sliders/'.$oldFile))) {
                unlink(public_path('backend/images/sliders/' . $oldFile));
            }
            $sliderDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Slider::where('id', intval($id))->update([
            'slider_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
