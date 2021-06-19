<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'faq_question'=>'required',
            'faq_answer'=>'required',
        ]);
        $faqs = new Faq();
        $faqs->faq_question = $request->faq_question;
        $faqs->faq_answer = $request->faq_answer;
        $faqs->save();
        return response()->json($faqs);
    }

    public function edit($id)
    {
        $data  = Faq::find($id);
        if($data){
          return response()->json([
              'success' => true,
              'data' => $data
            ]);
        }
        else{
          return response()->json([
              'success' => false,
              'data' => 'No information found'
            ]);
        }
    }

    public function updated(Request $request)
    {
        $request->validate([
            'faq_question'=>'required',
            'faq_answer'=>'required',
        ]);
        $faqs = Faq::find($request->category_id);
        $faqs->faq_question = $request->faq_question;
        $faqs->faq_answer = $request->faq_answer;
        $faqs->save();
        return response()->json($faqs);
    }

    public function destroy(Request $request)
    {
        $faqs = Faq::find($request->id);
        $faqs->delete();
        return response()->json('faqs');
    }
}
