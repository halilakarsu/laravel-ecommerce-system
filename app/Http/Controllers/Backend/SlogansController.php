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
    {       $request->validate([    'slogan_title'=>'required','slogan_description'=>'required']);
            $slogansStore=new Slogans();
            $slogansStore->slogan_title=$request->slogan_title;
            $slogansStore->slogan_description=$request->slogan_description;
            $slogansStore->save();
        if($slogansStore) {
            return redirect(route('slogans.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }

    public function edit($id)
    {
        $slogansEdit=Slogans::where('id',$id)->first();
        return view('backend.slogans.edit',compact('slogansEdit'));
    }

    public function update(Request $request, $id)
    {          $request->validate([
                'slogan_title'=>'required',
                'slogan_description'=>'required'
            ]);
            $slogansUpdate=Slogans::where('id',$id)->update([
                'slogan_title'=>$request->slogan_title,
                'slogan_description'=>$request->slogan_description
            ]);

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
            $sloganDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

}
