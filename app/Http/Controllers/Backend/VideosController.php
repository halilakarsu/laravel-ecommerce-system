<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class VideosController extends Controller
{
     public function index()
    { $videos=Videos::all()->sortBy('video_sort');
        return view('backend.videos.index',compact('videos'));
    }
    public function create()
    {
        return view('backend.videos.create');
    }
    public function sortable()
    {
         //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $videos = Videos::find(intval($value));
            $videos->video_sort=intval($key);
            $videos->save();
      }
        echo true;
    }
    public function store(Request $request)
    {
         if($request->hasFile('video_imagepath')){
              $request->validate([
                'video_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'video_title'=>'required',
                'video_description'=>'required',
                'video_status'=>'required'
              ]);
              $fileName=rand(1,99999).''.$request->video_imagepath->getClientOriginalName();
              $request->video_imagepath->move(public_path('backend/images/videos/'),$fileName);
             if($request->video_slug>3){
                 $videoSlug=Str::slug($request->video_slug);
             }else {
                 $videoSlug=Str::slug($request->video_title);
             }
              $videosStore=new Videos();
              $videosStore->video_title=$request->video_title;
              $videosStore->video_description=$request->video_description;
              $videosStore->video_status=$request->video_status;
              $videosStore->video_slug=$videoSlug;
              $videosStore->video_imagepath=$fileName;
              $videosStore->save();

          }else{
              return back()->with('error','Sanırım bir hata oluştu');
          }
         if($videosStore) {
             return redirect(route('videos.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }else {
             return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }
    }


    public function show(Videos $videos)
    {
        //
    }

    public function edit($id)
    {
        $videosEdit=Videos::where('id',$id)->first();
        return view('backend.videos.edit',compact('videosEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->video_slug>3){
        $videoSlug=Str::slug($request->video_slug);
    }else {
        $videoSlug=Str::slug($request->video_title);
    }
        if($request->hasFile('video_imagepath')){
            $request->validate([
                'video_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'video_title'=>'required',
                'video_description'=>'required',
                'video_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->video_imagepath->getClientOriginalName();
            $request->video_imagepath->move(public_path('backend/images/videos/'),$fileName);

            $videosUpdate=Videos::where('id',$id)->update([
                'video_imagepath'=>$fileName,
                'video_title'=>$request->video_title,
                 'video_slug'=>$videoSlug,
                'video_description'=>$request->video_description,
                'video_status'=>$request->video_status

            ]);
            $path='backend/images/videos/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'video_title'=>'required',
                'video_description'=>'required',
                'video_status'=>'required'
            ]);
            $videosUpdate=Videos::where('id',$id)->update([
                'video_title'=>$request->video_title,
                'video_slug'=>$videoSlug,
                'video_description'=>$request->video_description,
                'video_status'=>$request->video_status,
               ]);
        }


        if($videosUpdate){
            return redirect(route('videos.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $videoDelete = Videos::find(intval($id));
        if ($videoDelete) {
            $oldFile=$videoDelete->video_imagepath;
            if($oldFile && file_exists(public_path('backend/images/videos/'.$oldFile))) {
                unlink(public_path('backend/images/videos/' . $oldFile));
            }
            $videoDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Videos::where('id', intval($id))->update([
            'video_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
