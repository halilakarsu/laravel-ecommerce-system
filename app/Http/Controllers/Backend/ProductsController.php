<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    public function index()
    {
        $products=Products::all()->sortBy('product_sort');
        return view('backend.products.index',compact('products'));
    }
    public function create()
    {
        return view('backend.products.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $products = Products::find(intval($value));
            $products->product_sort=intval($key);
            $products->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('product_imagepath')){
            $request->validate([
                'product_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'product_title'=>'required',
                'product_description'=>'required',
                'product_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->product_imagepath->getClientOriginalName();
            $request->product_imagepath->move(public_path('backend/images/products/'),$fileName);
            if($request->product_slug>3){
                $productSlug=Str::slug($request->product_slug);
            }else {
                $productSlug=Str::slug($request->product_title);
            }
            $productsStore=new Products();
            $productsStore->product_title=$request->product_title;
            $productsStore->product_description=$request->product_description;
            $productsStore->product_status=$request->product_status;
            $productsStore->product_slug=$productSlug;
            $productsStore->product_imagepath=$fileName;
            $productsStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($productsStore) {
            return redirect(route('products.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Products $products)
    {
        //
    }

    public function edit($id)
    {
        $productsEdit=Products::where('id',$id)->first();
        return view('backend.products.edit',compact('productsEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->product_slug>3){
        $productSlug=Str::slug($request->product_slug);
    }else {
        $productSlug=Str::slug($request->product_title);
    }
        if($request->hasFile('product_imagepath')){
            $request->validate([
                'product_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'product_title'=>'required',
                'product_description'=>'required',
                'product_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->product_imagepath->getClientOriginalName();
            $request->product_imagepath->move(public_path('backend/images/products/'),$fileName);

            $productsUpdate=Products::where('id',$id)->update([
                'product_imagepath'=>$fileName,
                'product_title'=>$request->product_title,
                'product_slug'=>$productSlug,
                'product_description'=>$request->product_description,
                'product_status'=>$request->product_status

            ]);
            $path='backend/images/products/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'product_title'=>'required',
                'product_description'=>'required',
                'product_status'=>'required'
            ]);
            $productsUpdate=Products::where('id',$id)->update([
                'product_title'=>$request->product_title,
                'product_slug'=>$productSlug,
                'product_description'=>$request->product_description,
                'product_status'=>$request->product_status,
            ]);
        }


        if($productsUpdate){
            return redirect(route('products.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $productDelete = Products::find(intval($id));
        if ($productDelete) {
            $oldFile=$productDelete->product_imagepath;
            if($oldFile && file_exists(public_path('backend/images/products/'.$oldFile))) {
                unlink(public_path('backend/images/products/' . $oldFile));
            }
            $productDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Products::where('id', intval($id))->update([
            'product_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "Sıralama Değişti."]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
