<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Master;
use Illuminate\Support\Facades\DB;
use Session;


class MasterController extends Controller
{





    function category()
    {
        // $categoryInfo = Master::where('status' != 0)->get();
        $categoryInfo = DB::table('category')
            ->where('status', '!=', 0)->get();
        return view('master.category')->with('category_info', $categoryInfo);
    }

    function categorypost(Request $request)
    {

        // $request->validate([
        //     'category_name' => 'required',
        //            ]);
//   $category_name= $request ->category_name;

//   if($category_name == ""){
//     // return redirect("category")->with('error-message', 'ohh! Please Select Category Level');
//     echo json_encode(array("status" => "302", "message" => "ohh! Please Select Category Level"));
// }
        switch ($request->FromAction) {
            case 'Add':
                $data = array(
                    "category_name" => $request->category_name,

                );
                DB::table('category')->insert($data);
                echo json_encode(array("status" => "200", "message" => "Record inserted successfully."));
                break;

            case 'Edit':

                DB::table('category')->where("id", $request->cat_id)->update(["category_name" => $request->category_name]);
                echo json_encode(array("status" => "200", "message" => "Record Updated successfully."));
                break;

                // case 'Delete':

                //     DB::table('category')->where('id', $request->cat_id)->delete();
                //     echo json_encode(array("status"=>"200", "message"=>"Record Deleted successfully."));
                //     break;
        }
    }



    function GetCategoryid()
    {
        $id =  $_GET['id'];

        $categoryID_info = DB::table('category')->where('id', "=", $id)->first();
        return json_encode($categoryID_info);
    }

    function deleteCat()
    {

        $id =  $_POST['id'];

        DB::table('category')->where('id', $id)->delete();
        echo json_encode(array("status" => "200", "message" => "Record Deleted successfully."));
    }



    //Profession_Level

    function Profession_Level()
    {
        $categoryInfo = DB::table('category')->where('status', '!=', 0)->get();
    return view('master.profession_level')->with('category_info', $categoryInfo);
    }




    function question_set()
    {
        $categoryInfo = DB::table('category')->where('status', '!=', 0)->get();
        $questionInfo = DB::table('question_set')->where('status', '!=', 0)->get();

        $categoryInfo_join = DB::table('question_set')
        ->select('question_set.*', 'category.category_name')
        ->join('category', 'question_set.cat_id', '=', 'category.id')
        ->get();

        return view('master.question_sets',compact('categoryInfo','questionInfo','categoryInfo_join'));

    }


    function question_configurastion_step2(Request $request)
    {
           $cat_id =$request->cat_id;
           $profession_level =$request->profession_level;

            if($cat_id == 0)
            {
              return redirect("Question-Set")->with('error-message', 'ohh! Please Select Category');
            }
            if($profession_level ==0)
            {
              return redirect("Question-Set")->with('error-message', 'ohh! Please Select Profession Level');
            }


            if($cat_id !=0 & $profession_level !=0){

                Session::put('cat_id', $cat_id);
                Session::put('profession_level', $profession_level );
            //    $cat_id_session=  DB::table('category')->where('id',"=", $cat_id)->first();

              $question_info = DB::table('question_set')
              ->where('cat_id', '=', $cat_id)
              ->where('profession_id', '=', $profession_level)
              ->get();

              return view('master.question_configurastion_step2')->with('question_info',$question_info);

                }



            return redirect("Question-Set")->with('error-message', 'ohh! Please Select Configurastion');

    }



    function question_post(Request $request)
    {
           $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'answer' => 'required',
                   ]);


        $data = array(
            "question" => $request->question,
            "option1" => $request->option1,
            "option2" => $request->option2,
            "option3" => $request->option3,
            "option4" => $request->option4,
            "answer" => $request->answer,
            "cat_id" => $request->cat_id,
            "profession_id" => $request->profession_id,

        );
        DB::table('question_set')->insert($data);
        echo json_encode(array("status" => "200", "message" => "Record inserted successfully."));
    }

}
