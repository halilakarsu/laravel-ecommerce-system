<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
class SocialController extends Controller
{
    public function index()
    { $socials=Social::all()->sortBy('social_sort');
        return view('backend.socials.index',compact('socials'));
    }
    public function create()
    {
        return view('backend.socials.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $socials = Social::find(intval($value));
            $socials->social_sort=intval($key);
            $socials->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        $request->validate([
            'social_title'=>'required',
            'social_icon'=>'required',
        ]);

        $socialsStore=new Social();
        $socialsStore->social_title=$request->social_title;
        $socialsStore->social_link=$request->social_link;
        $socialsStore->social_icon=$request->social_icon;
        $socialsStore->save();
        if($socialsStore) {
            return redirect(route('socials.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }



    public function edit($id)
    {
        $socialsEdit=Social::where('id',$id)->first();
        return view('backend.socials.edit',compact('socialsEdit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'social_title'=>'required',
            'social_icon'=>'required',
        ]);
        $socialsUpdate=Social::where('id',$id)->update([
            'social_title'=>$request->social_title,
            'social_link'=>$request->social_link,
            'social_icon'=>$request->social_icon,

        ]);
        if($socialsUpdate){
            return redirect(route('socials.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $questionDelete = Social::find(intval($id));
        if ($questionDelete) {
            $questionDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Social::where('id', intval($id))->update([
            'social_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
