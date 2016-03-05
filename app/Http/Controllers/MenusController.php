<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

/**
 * Class MenusController
 * @package App\Http\Controllers
 */
class MenusController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Menus Controller
    |--------------------------------------------------------------------------
    |
    |This controller provides views and feeds data to the admin's control
    |panel's Menus Management section.
    |
    */

    /**
     * Constructor for the MenusController class. Checks if a user has sufficient permission
     * to access the Admin area.
     *
     */
    public function __construct()
    {
        // Check if User is Authenticated
        $this->middleware('auth', ['except' => ['blockNotice']]);

        // Check if the authenticated user is an admin
        $this->middleware('isAdmin', ['except' => ['blockNotice']]);
    }
    /**
     * Returns the Menus view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex (Request $request){
        return view('nipuna.menus');   
    }

    /**
     * Returns all the Menus from the DB for the DataTable.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenus(Request $request){
        $result = DB::table('menus')->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    /**
     * Returns all the items for a given row number of a Menu.
     *
     * @param Request $request
     * @return mixed
     */
    public function getMenuitemdataload(Request $request){
        $rowno = $request->input('rowno');

        $result = DB::table('detailed_menus')->where('menu_id',$rowno)->get();
        return $result;
    }

    /**
     * Returns the details of a Menu when the row number is given.
     *
     * @param Request $request
     * @return mixed
     */
    public function getRetrievedetails(Request $request){
        $menu_id=$request->input('row');

        $result = DB::table('menus')->where('menu_id','=',$menu_id)->get();
        return $result;
    }

    /**
     * Returns all the items in a Menu when the row number is given.
     *
     * @param Request $request
     * @return mixed
     */
    public function getRetrieveitemdetails(Request $request){
        $row=$request->input('row');

        $result = DB::table('detailed_menus')->where('id','=',$row)->get();
        return $result;
    }

    /**
     * Returns all the items in a Menu in JSON format when the row number is given.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetailedmenus(Request $request){
        $row = $request->input('row');

        $result = DB::table('detailed_menus')->where('menu_id',$row)->get();
        return response()->json(['count' => count($result), 'data' => $result]);
    }

    /**
     * Returns the number of items in a menu.
     *
     * @param Request $request
     * @return mixed
     */
    public function getMenuitemcount(Request $request){
        $menu_id = $request->input('menu_id');
        $result = DB::table('DETAILED_MENUS')->where('menu_id',$menu_id)->count();
        return $result;
    }

    /**
     * Insert a new Menu and return the row number of the new entry.
     *
     * @param Request $request
     * @return mixed
     */
    public function getAddmenu(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $rate = $request->input('rate');

        $rowno=DB::table('menus')->insertGetId(array('category'=> $category,'description'=> $description,'rate'=> $rate));
        return $rowno;
    }

    /**
     * Insert a new item for the Menu.
     *
     * @param Request $request
     * @return int
     */
    public function getAddmenuitem(Request $request){
        $menu_number = $request->input('menu_number');
        $item_name = $request->input('item_name');
        $item_price = $request->input('item_price');

        DB::table('detailed_menus')->insert(array('menu_id'=>$menu_number,'item_name'=>$item_name,'price'=>$item_price));
        return 1;
    }

    /**
     * Update an item of the Menu.
     *
     * @param Request $request
     */
    public  function getUpdateitem(Request $request){
        $rownumber = $request->input('id');
        $item_name = $request->input('item_name');
        $price = $request->input('price');

        DB::table('DETAILED_MENUS')->where('id',$rownumber)->update(array('item_name'=> $item_name,'price'=> $price));
    }

    /**
     * Update an existing Menu.
     *
     * @param Request $request
     */
    public function getUpdatemenu(Request $request){
        $category = $request->input('category');
        $description = $request->input('description');
        $rate = $request->input('rate');
        $row=$request->input('row');

        DB::table('menus')->where('menu_id',$row)->update(array('category'=> $category,'description'=> $description,'rate'=> $rate));
    }

    /**
     * Delete the Menu when the row number is given.
     *
     * @param Request $request
     */
    public function getDeleterow(Request $request){
        $menu_id=$request->input('row');
        DB::table('menus')->where('menu_id','=',$menu_id)->delete();
        DB::table('DETAILED_MENUS')->where('menu_id','=',$menu_id)->delete();

    }

    /**
     * Delete an item when the row number is given.
     *
     * @param Request $request
     */
    public function getDeleteitem(Request $request){
        $item_id=$request->input('row');
        DB::table('DETAILED_MENUS')->where('id','=',$item_id)->delete();
    }



}
