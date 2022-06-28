<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class quizController extends Controller
{


    function generating_quiz()
    {
        $categoryInfo = DB::table('category')->where('status', '!=', 0)->get();

        return view('quiz.validate',compact('categoryInfo'));
    }


    function validate_from(Request $Request)
    {
        $Request->validate([
                    'candidate_name' => 'required',
                    'candidate_email' => 'required',
                    'candidate_mobile' => 'required',
                    'candidate_category' => 'required',
                    'candidate_level' => 'required',
                        ]);
echo "<pre>";
echo $Request;
die;


    }

function validate_email()
{
    return view('quiz.validate_email');

}







}
