<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class ResultController extends Controller
{


function show_result(){
    // echo "Show Result Controller";
    // die;
    // $result_Info = DB::table('candidate_aptitude')->where('status', '=', 2)->get();

    $result_Info = DB::table('candidate_aptitude')
    ->select('candidate_aptitude.*', 'category.category_name')
    ->join('category', 'candidate_aptitude.candidate_category', '=', 'category.id')
    ->where('candidate_aptitude.status', '=', '2')
    ->get();

return view('result.show_result')->with('result_Info', $result_Info);
}


function show_result_form_id(Request $Request)
{
     $candidate_email = $Request->candidate_email;
     $resultInfo = DB::table('aptitude_result')->where('candidate_email', '=', $candidate_email)->get();

     $question_answer =array();

     foreach($resultInfo as $row)
     {
       $question_answer = $row->question_answer;
     }

    //  Candidate submite answer
$question_answer_Row =json_decode($question_answer);



$result = [];
$count = 0;
$total_question =0;
$correct_answer =0;
foreach($question_answer_Row as $anskey)
{

    $quesID  = $anskey->que_id;
    $resultInfo = DB::table('question_set')->where('id', '=', $quesID)->first();


    if($resultInfo->answer == $anskey->ans)
    {
        $result[] = array('que_id'=>$quesID, 'ans'=>'1');
        $count++;
        $correct_answer++;
    }
else{
    $result[] = array('que_id'=>$quesID, 'ans'=>'0');

    }

}
$total_percentage =  $correct_answer / count($question_answer_Row) * 100 ;
$total_percentage = number_format((float)$total_percentage, 2, '.', '');  // Outputs -> 105.00

 $result['email']=array('candidate_email' => $candidate_email);
 $result['question_count']=array('question_count' => count($question_answer_Row));
 $result['correct_answer']=array('correct_answer' => $correct_answer);
 $result['total_percentage']=array('total_percentage' => $total_percentage);

 // echo "<pre>";
// print_r($result);
// die;
echo json_encode($result);

}


function download_result_from_email(Request $Request)
{
    $candidate_email = $Request->candidate_email;
    // getting candidate submited result
    $resultInfo = DB::table('aptitude_result')->where('candidate_email', '=', $candidate_email)->get();


    $question_answer =array();

    foreach($resultInfo as $row)
    {
      $question_answer = $row->question_answer;
    }

   //  Candidate submite answer
$question_answer_Row =json_decode($question_answer);

$result = [];

$correct_answer =0;
foreach($question_answer_Row as $anskey)
{

   $quesID  = $anskey->que_id;

//    getting connrect answer from question id
   $resultInfo = DB::table('question_set')->where('id', '=', $quesID)->first();


   if($resultInfo->answer == $anskey->ans)
   {
       $result[] = array('candidate_que_id'=>$quesID,'candidate_answer'=>$anskey->ans, 'correct_answer'=> $resultInfo->answer, 'ans'=>'1');

       $correct_answer++;
   }
else{
   $result[] = array('candidate_que_id'=>$quesID, 'candidate_answer'=>$anskey->ans, 'correct_answer'=> $resultInfo->answer, 'ans'=>'0');

   }

}




echo json_encode($result);




die;
}




}
