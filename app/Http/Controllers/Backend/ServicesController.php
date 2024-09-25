<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ServicesController extends Controller
{
    public function index()
    { $services=Services::all()->sortBy('service_sort');
        return view('backend.services.index',compact('services'));
    }
    public function create()
    {
        return view('backend.services.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $services = Services::find(intval($value));
            $services->service_sort=intval($key);
            $services->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('service_imagepath')){
            $request->validate([
                'service_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'service_title'=>'required',
                'service_name'=>'required',
                'service_description'=>'required',
               ]);
            $fileName=rand(1,99999).''.$request->service_imagepath->getClientOriginalName();
            $request->service_imagepath->move(public_path('backend/images/services/'),$fileName);
            if($request->service_slug>3){
                $serviceSlug=Str::slug($request->service_slug);
            }else {
                $serviceSlug=Str::slug($request->service_title);
            }
            $servicesStore=new Services();
            $servicesStore->service_title=$request->service_title;
            $servicesStore->service_name=$request->service_name;
            $servicesStore->service_description=$request->service_description;
            $servicesStore->service_slug=$serviceSlug;
            $servicesStore->service_imagepath=$fileName;
            $servicesStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($servicesStore) {
            return redirect(route('services.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Services $services)
    {
        //
    }

    public function edit($id)
    {
        $servicesEdit=Services::where('id',$id)->first();
        return view('backend.services.edit',compact('servicesEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->service_slug>3){
        $serviceSlug=Str::slug($request->service_slug);
    }else {
        $serviceSlug=Str::slug($request->service_title);
    }
        if($request->hasFile('service_imagepath')){
            $request->validate([
                'service_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'service_title'=>'required',
                'service_name'=>'required',
                'service_description'=>'required',
                 ]);
            $fileName=rand(1,99999).'-'.$request->service_imagepath->getClientOriginalName();
            $request->service_imagepath->move(public_path('backend/images/services/'),$fileName);

            $servicesUpdate=Services::where('id',$id)->update([
                'service_imagepath'=>$fileName,
               'service_name'=>$request->service_name,
                'service_title'=>$request->service_title,
                'service_slug'=>$serviceSlug,
                'service_description'=>$request->service_description,
                  ]);
            $path='backend/images/services/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'service_title'=>'required',
                'service_name'=>'required',
                'service_description'=>'required',
                   ]);
            $servicesUpdate=Services::where('id',$id)->update([
                'service_title'=>$request->service_title,
                'service_name'=>$request->service_name,
                'service_slug'=>$serviceSlug,
                'service_description'=>$request->service_description,
              ]);
        }


        if($servicesUpdate){
            return redirect(route('services.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $serviceDelete = Services::find(intval($id));
        if ($serviceDelete) {
            $oldFile=$serviceDelete->service_imagepath;
            if($oldFile && file_exists(public_path('backend/images/services/'.$oldFile))) {
                unlink(public_path('backend/images/services/' . $oldFile));
            }
            $serviceDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Services::where('id', intval($id))->update([
            'service_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
