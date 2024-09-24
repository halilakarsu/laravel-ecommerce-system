<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class OrdersController extends Controller
{
    public function index()
    { $orders=Blogs::all()->sortBy('blog_sort');
        return view('backend.orders.index',compact('orders'));
    }
    public function create()
    {
        return view('backend.orders.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $orders = Blogs::find(intval($value));
            $orders->blog_sort=intval($key);
            $orders->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
        if($request->hasFile('blog_imagepath')){
            $request->validate([
                'blog_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
            ]);
            $fileName=rand(1,99999).''.$request->blog_imagepath->getClientOriginalName();
            $request->blog_imagepath->move(public_path('backend/images/orders/'),$fileName);
            if($request->blog_slug>3){
                $blogSlug=Str::slug($request->blog_slug);
            }else {
                $blogSlug=Str::slug($request->blog_title);
            }
            $ordersStore=new Blogs();
            $ordersStore->blog_title=$request->blog_title;
            $ordersStore->blog_description=$request->blog_description;
            $ordersStore->blog_status=$request->blog_status;
            $ordersStore->blog_slug=$blogSlug;
            $ordersStore->blog_imagepath=$fileName;
            $ordersStore->save();

        }else{
            return back()->with('error','Sanırım bir hata oluştu');
        }
        if($ordersStore) {
            return redirect(route('orders.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }


    public function show(Blogs $orders)
    {
        //
    }

    public function edit($id)
    {
        $ordersEdit=Blogs::where('id',$id)->first();
        return view('backend.orders.edit',compact('ordersEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->blog_slug>3){
        $blogSlug=Str::slug($request->blog_slug);
    }else {
        $blogSlug=Str::slug($request->blog_title);
    }
        if($request->hasFile('blog_imagepath')){
            $request->validate([
                'blog_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->blog_imagepath->getClientOriginalName();
            $request->blog_imagepath->move(public_path('backend/images/orders/'),$fileName);

            $ordersUpdate=Blogs::where('id',$id)->update([
                'blog_imagepath'=>$fileName,
                'blog_title'=>$request->blog_title,
                'blog_slug'=>$blogSlug,
                'blog_description'=>$request->blog_description,
                'blog_status'=>$request->blog_status

            ]);
            $path='backend/images/orders/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'blog_title'=>'required',
                'blog_description'=>'required',
                'blog_status'=>'required'
            ]);
            $ordersUpdate=Blogs::where('id',$id)->update([
                'blog_title'=>$request->blog_title,
                'blog_slug'=>$blogSlug,
                'blog_description'=>$request->blog_description,
                'blog_status'=>$request->blog_status,
            ]);
        }


        if($ordersUpdate){
            return redirect(route('orders.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $blogDelete = Blogs::find(intval($id));
        if ($blogDelete) {
            $oldFile=$blogDelete->blog_imagepath;
            if($oldFile && file_exists(public_path('backend/images/orders/'.$oldFile))) {
                unlink(public_path('backend/images/orders/' . $oldFile));
            }
            $blogDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Blogs::where('id', intval($id))->update([
            'blog_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
