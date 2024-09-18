<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class TypesController extends Controller
{
    public function index()
    { $types=Types::with('categories')->get();
        return view('backend.types.index',compact('types'));
    }
    public function create()
    {    $categories=Categories::all();
        return view('backend.types.create',compact('categories'));
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
    {            $request->validate([
                 'type_title'=>'required',
                 'type_status'=>'required',
                 'categori_id'=>'required',
            ]);
            $typesStore=new Types();
            $typesStore->type_title=$request->type_title;
           $typesStore->categori_id=$request->categori_id;
            $typesStore->type_status=$request->type_status;
            $typesStore->save();
             if($typesStore) {
            return redirect(route('types.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }
    public function edit($id)
    {
        $typesEdit=Types::with('categories')->where('id',$id)->first();
        $categories=Categories::all()->sortBy('categori_sort');
        return view('backend.types.edit',compact('typesEdit','categories'));
    }

    public function update(Request $request, $id)
    {       $request->validate([
                'type_title'=>'required',
                'type_status'=>'required',
                'categori_id'=>'required'
                       ]);
            $typesUpdate=Types::where('id',$id)->update([
                'type_title'=>$request->type_title,
                'type_status'=>$request->type_status,
                'categori_id'=>$request->categori_id
            ]);
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
