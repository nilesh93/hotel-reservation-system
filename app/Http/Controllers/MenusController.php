<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MenusController extends Controller
{
    public function getIndex (Request $request){
        
        return view('nipuna.menus');
        
        
    }

    public function getMenus(Request $request){
    
    $result = DB::table('menus')->get();
            return response()->json(['count' => count($result), 'data' => $result]);

    }

    public function getAddmenu(Request $request){
    $category = $request->input('category');
    $description = $request->input('description');
    $rate = $request->input('rate');

    DB::table('menus')->insert(array('category'=> $category,'description'=> $description,'rate'=> $rate));
    return 1;


    }

    public function getDeleterow(Request $request){
        $menu_id=$request->input('row');
        DB::table('menus')->where('menu_id','=',$menu_id)->delete();

    }

     public function getRetrievedetails(Request $request){
        $menu_id=$request->input('row');
        $result = DB::table('menus')->where('menu_id','=',$menu_id)->get();
        return $result;
    }

    public function getRetrieveitemdetails(Request $request){
        $row=$request->input('row');
        $result = DB::table('detailed_menus')->where('id','=',$row)->get();
        return $result;
    }

    public function getUpdatemenu(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $rate = $request->input('rate');
        $row=$request->input('row');
        DB::table('menus')->where('menu_id',$row)->update(array('category'=> $category,'description'=> $description,'rate'=> $rate));
    }

    public function getDetailedmenus(Request $request){
        $row = $request->input('row');
        $result = DB::table('detailed_menus')->where('menu_id',$row)->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }
}
