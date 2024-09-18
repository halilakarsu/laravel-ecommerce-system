<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CustomersController extends Controller
{
     public function index()
    { $customers=Customers::all()->sortBy('customer_sort');
        return view('backend.customers.index',compact('customers'));
    }
    public function create()
    {
        return view('backend.customers.create');
    }
    public function sortable()
    {
         //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $customers = Customers::find(intval($value));
            $customers->customer_sort=intval($key);
            $customers->save();
      }
        echo true;
    }
    public function store(Request $request)
    {
         if($request->hasFile('customer_imagepath')){
              $request->validate([
                'customer_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'customer_title'=>'required',
                'customer_description'=>'required',
                'customer_status'=>'required'
              ]);
              $fileName=rand(1,99999).''.$request->customer_imagepath->getClientOriginalName();
              $request->customer_imagepath->move(public_path('backend/images/customers/'),$fileName);
             if($request->customer_slug>3){
                 $customerSlug=Str::slug($request->customer_slug);
             }else {
                 $customerSlug=Str::slug($request->customer_title);
             }
              $customersStore=new Customers();
              $customersStore->customer_title=$request->customer_title;
              $customersStore->customer_description=$request->customer_description;
              $customersStore->customer_status=$request->customer_status;
              $customersStore->customer_slug=$customerSlug;
              $customersStore->customer_imagepath=$fileName;
              $customersStore->save();

          }else{
              return back()->with('error','Sanırım bir hata oluştu');
          }
         if($customersStore) {
             return redirect(route('customers.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }else {
             return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }
    }


    public function show(Customers $customers)
    {
        //
    }

    public function edit($id)
    {
        $customersEdit=Customers::where('id',$id)->first();
        return view('backend.customers.edit',compact('customersEdit'));
    }

    public function update(Request $request, $id)
    {     if($request->customer_slug>3){
        $customerSlug=Str::slug($request->customer_slug);
    }else {
        $customerSlug=Str::slug($request->customer_title);
    }
        if($request->hasFile('customer_imagepath')){
            $request->validate([
                'customer_imagepath'=>'required|image|mimes:jpg,jpeg,gif|max:2048',
                'customer_title'=>'required',
                'customer_description'=>'required',
                'customer_status'=>'required'
            ]);
            $fileName=rand(1,99999).'-'.$request->customer_imagepath->getClientOriginalName();
            $request->customer_imagepath->move(public_path('backend/images/customers/'),$fileName);

            $customersUpdate=Customers::where('id',$id)->update([
                'customer_imagepath'=>$fileName,
                'customer_title'=>$request->customer_title,
                 'customer_slug'=>$customerSlug,
                'customer_description'=>$request->customer_description,
                'customer_status'=>$request->customer_status

            ]);
            $path='backend/images/customers/'.$request->oldFile;
            if(file_exists($path)) {
                @unlink(public_path($path));
            }
        }else{
            $request->validate([
                'customer_title'=>'required',
                'customer_description'=>'required',
                'customer_status'=>'required'
            ]);
            $customersUpdate=Customers::where('id',$id)->update([
                'customer_title'=>$request->customer_title,
                'customer_slug'=>$customerSlug,
                'customer_description'=>$request->customer_description,
                'customer_status'=>$request->customer_status,
               ]);
        }


        if($customersUpdate){
            return redirect(route('customers.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $customerDelete = Customers::find(intval($id));
        if ($customerDelete) {
            $oldFile=$customerDelete->customer_imagepath;
            if($oldFile && file_exists(public_path('backend/images/customers/'.$oldFile))) {
                unlink(public_path('backend/images/customers/' . $oldFile));
            }
            $customerDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Customers::where('id', intval($id))->update([
            'customer_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
