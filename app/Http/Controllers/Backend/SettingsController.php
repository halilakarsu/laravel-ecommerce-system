<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
class SettingsController extends Controller
{
    public function index(){
        $settings=Settings::all();
        return view('backend.settings.index',compact('settings'));
    }
    public function edit($id){
        $editSettings=Settings::where('id',$id)->first();
        return view('backend.settings.edit',compact('editSettings'));
    }

    public function update(Request $request, $id){
          if($request->hasFile('settings_value')){
           $request->validate([
               'settings_value'=>'required|image|mimes:jpg,jepg,png|max:2048']);
            $fileName=rand(1,999999).'-'.$request->settings_value->getClientOriginalName();
            $request->settings_value->move(public_path('backend/images/settings'),$fileName);
            $request->settings_value=$fileName;

       } else {
              $request->validate(['settings_value'=>'required']);

          }
       $updateSettings=Settings::where('id',$id)->update([
       'settings_value'=>$request->settings_value]);
       if($updateSettings) {
           return redirect(route('settings.home'))->with('success', 'Güncelleme Başarılı Bir şekilde Gerçekleşti.');
       }
           return back()->with('error', 'Sanırım bir hata oluştu');

    }

}
