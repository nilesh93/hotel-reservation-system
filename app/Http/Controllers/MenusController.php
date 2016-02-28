<?php
/*
|--------------------------------------------------------------------------
|MenusController
|--------------------------------------------------------------------------
|
| This controller handles the  rooms check availability part for
| each room types.
|
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MenusController extends Controller
{

    //Returns the Menus view
    public function getIndex (Request $request){
        return view('nipuna.menus');   
    }

    //Returns all the Menus from the DB for the DataTable
    public function getMenus(Request $request){
        $result = DB::table('menus')->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    //Returns all the items for a given row number of a Menu
    public function getMenuitemdataload(Request $request){
        $rowno = $request->input('rowno');

        $result = DB::table('detailed_menus')->where('menu_id',$rowno)->get();
        return $result;
    }

    //Returns the details of a Menu when the row number is given
    public function getRetrievedetails(Request $request){
        $menu_id=$request->input('row');

        $result = DB::table('menus')->where('menu_id','=',$menu_id)->get();
        return $result;
    }

    //Returns all the items in a Menu when the row number is given
    public function getRetrieveitemdetails(Request $request){
        $row=$request->input('row');

        $result = DB::table('detailed_menus')->where('id','=',$row)->get();
        return $result;
    }

    //Returns all the items in a Menu in JSON format when the row number is given
    public function getDetailedmenus(Request $request){
        $row = $request->input('row');

        $result = DB::table('detailed_menus')->where('menu_id',$row)->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    //Returns the number of items in a menu
    public function getMenuitemcount(Request $request){
        $menu_id = $request->input('menu_id');
        $result = DB::table('DETAILED_MENUS')->where('menu_id',$menu_id)->count();
        return $result;
    }

    //Insert a new Menu and return the row number of the new entry
    public function getAddmenu(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $rate = $request->input('rate');

        $rowno=DB::table('menus')->insertGetId(array('category'=> $category,'description'=> $description,'rate'=> $rate));
        return $rowno;
    }

    //Insert a new item for the Menu
    public function getAddmenuitem(Request $request){
        $menu_number = $request->input('menu_number');
        $item_name = $request->input('item_name');
        $item_price = $request->input('item_price');

        DB::table('detailed_menus')->insert(array('menu_id'=>$menu_number,'item_name'=>$item_name,'price'=>$item_price));
        return 1;
    }

    //Update an item of the Menu
    public  function getUpdateitem(Request $request){
        $rownumber = $request->input('id');
        $item_name = $request->input('item_name');
        $price = $request->input('price');

        DB::table('DETAILED_MENUS')->where('id',$rownumber)->update(array('item_name'=> $item_name,'price'=> $price));
    }

    //Update an existing Menu
    public function getUpdatemenu(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $rate = $request->input('rate');
        $row=$request->input('row');

        DB::table('menus')->where('menu_id',$row)->update(array('category'=> $category,'description'=> $description,'rate'=> $rate));
    }
    
    //Delete the Menu when the row number is given
    public function getDeleterow(Request $request){
        $menu_id=$request->input('row');
        DB::table('menus')->where('menu_id','=',$menu_id)->delete();
        DB::table('DETAILED_MENUS')->where('menu_id','=',$menu_id)->delete();

    }

    //Delete an item when the row number is given
    public function getDeleteitem(Request $request){
        $item_id=$request->input('row');
        DB::table('DETAILED_MENUS')->where('id','=',$item_id)->delete();
    }
}
