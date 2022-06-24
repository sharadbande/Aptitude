<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Master;
use Illuminate\Support\Facades\DB;


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
        $categoryInfo = DB::table('category')
        ->where('status', '!=', 0)->get();
    return view('master.profession_level')->with('category_info', $categoryInfo);
    }

}
