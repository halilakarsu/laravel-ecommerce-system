<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    public function index()
    {
        $menuUst= Menu::where('menu_ust', 0)->get()->sortBy('menu_sort');
        $menuAlt = Menu::where('menu_ust', '>', 0)->get()->sortBy('menu_sort');
        return view('backend.menus.index',compact('menuUst','menuAlt'));
    }
    public function create()
    {    $menus=Menu::all()->sortBy('menu_sort');
        return view('backend.menus.create',compact('menus'));
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $menus = Menu::find(intval($value));
            $menus->menu_sort=intval($key);
            $menus->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
               $request->validate([
                'menu_title'=>'required',
                  'menu_ust'=>'required',
                'menu_slug'=>'required',
                     ]);
            if($request->menu_slug>3){
                $menuSlug=Str::slug($request->menu_slug);
            }else {
                $menuSlug=Str::slug($request->menu_title);
            }
            $menusStore=new Menu();
            $menusStore->menu_title=$request->menu_title;
            $menusStore->menu_ust=$request->menu_ust;
           $menusStore->menu_slug=$menuSlug;
            $menusStore->save();
        if($menusStore) {
            return redirect(route('menus.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }
    public function edit($id)
    {
        $menusEdit=Menu::where('id',$id)->first();
        return view('backend.menus.edit',compact('menusEdit'));
    }
    public function update(Request $request, $id)
    {     if($request->menu_slug>3){
        $menuSlug=Str::slug($request->menu_slug);
    }else {
        $menuSlug=Str::slug($request->menu_title);
    }           $request->validate([
                'menu_title'=>'required',
                'menu_ust'=>'required',
                'menu_slug'=>'required',
                  ]);
                $menusUpdate=Menu::where('id',$id)->update([
                'menu_title'=>$request->menu_title,
                'menu_ust'=>$request->menu_ust,
                'menu_slug'=>$menuSlug
               ]);

        if($menusUpdate){
            return redirect(route('menus.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $menuDelete = Menu::find(intval($id));
        if ($menuDelete) {
            $menuDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Menu::where('id', intval($id))->update([
            'menu_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
