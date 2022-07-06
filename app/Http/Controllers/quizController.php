<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Session;
use Artisan;




class quizController extends Controller
{


    function generating_quiz()
    {
        $categoryInfo = DB::table('category')->where('status', '!=', 0)->get();

        return view('quiz.validate', compact('categoryInfo'));
    }


    function validate_from(Request $Request)
    {
        $Request->validate([
            'candidate_name' => 'required',
            'candidate_email' => 'unique:candidate_aptitude,candidate_email',
            'candidate_mobile' => 'required',
            'candidate_category' => 'required',
            'candidate_level' => 'required',
        ]);
        //    After add here some more field like user IP, user device, etc

        $data = array(
            'candidate_name' => $Request->candidate_name,
            'candidate_email' => $Request->candidate_email,
            'candidate_mobile' => $Request->candidate_mobile,
            'candidate_category' => $Request->candidate_category,
            'candidate_level' => $Request->candidate_level,
        );

        $candidate_insert =  DB::table('candidate_aptitude')->insertGetId($data);

        if ($candidate_insert == true) {
            Session::put('candidate_name', $Request->candidate_name);
            Session::put('candidate_email', $Request->candidate_email);
            Session::put('candidate_mobile', $Request->candidate_mobile);
            Session::put('candidate_category', $Request->candidate_category);
            Session::put('candidate_level', $Request->candidate_level);
            Session::put('candidate_id', $candidate_insert);

            return redirect("Aptitude-Start");
        }
        return redirect("Generate-Quiz")->with('error-message', 'Something goes to Wrong...!');
    }





//****************************************************************************
// START APTITUDE
//****************************************************************************

    function startaptitude()
    {
        if (empty(Session::get('candidate_id'))) {
            return redirect("Generate-Quiz")->with('error-message', 'Please fill Form First');
        }

        $cann_ID = Session::get('candidate_id');

        $candidate_added_on_time = DB::table('candidate_aptitude')
            ->where('id', '=', $cann_ID)
            ->get();

        // echo "<pre>";
        // print_r($candidate_added_on_time);
        // die;
        $candidate_added_on_time[0]->added_on;
        $CurrentTime =  $candidate_added_on_time[0]->added_on; //Exam end time based on DB->added_on time
        // Addiing +20 min from Aptitude Start time
        $settingEndTime = date('M d,Y H:i:s', strtotime($CurrentTime . ' +100 minutes'));


        // session array to Page
        $candidate_session = array(
            'candidate_name' => Session::get('candidate_name'),
            'candidate_email' => Session::get('candidate_email'),
            'candidate_mobile' => Session::get('candidate_mobile'),
            'candidate_category' => Session::get('candidate_category'),
            'candidate_level' => Session::get('candidate_level'),
            'candidate_id' => Session::get('candidate_id'),
        );

        $candidate_category = Session::get('candidate_category');
        $candidate_level = Session::get('candidate_level');


        // $categoryInfo = DB::table('category')->inRandomOrder()->limit(5)->where('status', '!=', 0)->get();

        $question_info = DB::table('question_set')
            ->select('question_set.*', 'category.category_name')
            ->join('category', 'question_set.cat_id', '=', 'category.id')
            ->where('cat_id', '=', $candidate_category)
            ->where('profession_id', '=', $candidate_level)
            ->inRandomOrder()
            ->limit(5)
            ->get(['id', 'question', 'option1', 'option2', 'option3', 'option4', 'cat_id', 'profession_id', 'status', 'category_name'])->toArray();

        return view('quiz.Start-Aptitude', compact('candidate_session', 'question_info', 'settingEndTime'));
    }

//****************************************************************************
// START APTITUDE
//****************************************************************************

    function storeaptitude(Request $Request)
    {

        $newdata = array();
        $ques = array();
        $newdata = $Request->all();

        foreach ($newdata as $key => $items) {
            $que = explode('-', $key);

            if (count($que) > 1) {
                $ques[] = array('que_id' => $que[1], 'ans' => $items);
            }
        }

        $candidate_name = $newdata['candidate_name'];
        $candidate_email = $newdata['candidate_email'];
        $candidate_id = $newdata['candidate_id'];
        $question_answer = json_encode($ques);


// if candidate resubmit his exam
        // $candidate_id_info  = DB::table('aptitude_result')
        //        ->where('candidate_id', '=', $candidate_id)->first();
        // if ($candidate_id_info != null) {
        //     // return redirect("Generate-Quiz")->with('error-message', 'Something goes to Wrong...!');
        //     return   json_encode(array("status" => "302", "message" => "You have already Submited youe exam...!", "url" => "/Generate-Quiz"));

        // }
// if candidate resubmit his exam


        $data = array(
            'candidate_name' => $candidate_name,
            'candidate_email' => $candidate_email,
            'candidate_id' => $candidate_id,
            'question_answer' => $question_answer,
        );
        DB::table('aptitude_result')->insert($data);
        DB::table('candidate_aptitude')->where('candidate_email', $candidate_email)->update(array('status' => 2));


        $Request->session()->forget('candidate_name');
        $Request->session()->forget('candidate_email');
        $Request->session()->forget('candidate_mobile');
        $Request->session()->forget('candidate_category');
        $Request->session()->forget('candidate_level');
        $Request->session()->forget('candidate_id');

        echo json_encode(array("status" => "200", "message" => "Record inserted successfully.", "url" => "Generate-Quiz"));

    }

  function endaptitude(Request $Request)
    {
        echo "<pre>";
        print_r($Request);
        echo "sampli exam ja ghari";
        die;
    }



    function validate_email()
    {
        return view('quiz.validate_email');
    }
}
