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
    {          $request->validate([
                'customer_name'=>'required',
                'customer_phone'=>'required'
              ]);
              $customersStore=new Customers();
              $customersStore->customer_name=$request->customer_name;
              $customersStore->customer_phone=$request->customer_phone;
              $customersStore->customer_email=$request->customer_email;
              $customersStore->customer_postCode=$request->customer_postCode;
              $customersStore->customer_il=$request->customer_il;
              $customersStore->customer_ilce=$request->customer_ilce;
              $customersStore->customer_address=$request->customer_address;
              $customersStore->customer_description=$request->customer_description;
              $customersStore->save();

         if($customersStore) {
             return redirect(route('customers.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
         }else {
             return back()->with('error', ['title'=>'Kayıt Ekleme','message'=>'Olmadı.']);
         }
    }

    public function edit($id)
    {
        $customersEdit=Customers::where('id',$id)->first();
        return view('backend.customers.edit',compact('customersEdit'));
    }

    public function update(Request $request, $id){
                $request->validate([
                'customer_name'=>'required',
                'customer_description'=>'required'
            ]);
            $customersUpdate=Customers::where('id',$id)->update([
                'customer_name'=>$request->customer_name,
                'customer_phone'=>$request->customer_phone,
                'customer_email'=>$request->customer_email,
                'customer_il'=>$request->customer_il,
                'customer_ilce'=>$request->customer_ilce,
                'customer_address'=>$request->customer_address,
                'customer_postCode'=>$request->customer_postCode,
                'customer_description'=>$request->customer_description,
            ]);
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
