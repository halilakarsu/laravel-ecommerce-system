<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class QuestionsController extends Controller
{
    public function index()
    { $questions=Questions::all()->sortBy('question_sort');
        return view('backend.questions.index',compact('questions'));
    }
    public function create()
    {
        return view('backend.questions.create');
    }
    public function sortable()
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key=>$value) {
            $questions = Questions::find(intval($value));
            $questions->question_sort=intval($key);
            $questions->save();
        }
        echo true;
    }
    public function store(Request $request)
    {
            $request->validate([
                'question_title'=>'required',
                'question_description'=>'required',
            ]);

            $questionsStore=new Questions();
            $questionsStore->question_title=$request->question_title;
            $questionsStore->question_description=$request->question_description;
            $questionsStore->save();
        if($questionsStore) {
            return redirect(route('questions.index'))->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }else {
            return back()->with('success', ['title'=>'Kayıt Ekleme','message'=>'Başarı ile gerçekleşti.']);
        }
    }



    public function edit($id)
    {
        $questionsEdit=Questions::where('id',$id)->first();
        return view('backend.questions.edit',compact('questionsEdit'));
    }

    public function update(Request $request, $id)
    {
            $request->validate([
                'question_title'=>'required',
                'question_description'=>'required',
            ]);
                $questionsUpdate=Questions::where('id',$id)->update([
                'question_title'=>$request->question_title,
                'question_description'=>$request->question_description,

            ]);
                if($questionsUpdate){
            return redirect(route('questions.index'))->with('success', ['title'=>'Güncelleme','message'=>'Başarı ile gerçekleşti.']);

        }else {
            return back()->with('error', ['title'=>'Güncelleme','message'=>'Başarısız.']);
        }
    }
    public function destroy($id)
    {
        $questionDelete = Questions::find(intval($id));
        if ($questionDelete) {
             $questionDelete->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

    public function switch(Request $request, $id){
        $switchStatus = Questions::where('id', intval($id))->update([
            'question_status' => $request->sts // Status bilgisini request üzerinden alıyoruz.
        ]);

        if($switchStatus){
            return response()->json(['success' => true, 'message' => "İşlem Başarılı"]);
        } else {
            return response()->json(['error' => false, 'message' => "İşlem Başarısız"]);
        }
    }

}
