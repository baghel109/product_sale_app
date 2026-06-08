<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
// use Dotenv\Validator;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Illuminate\Support\Facades\Validator;


class MainController extends Controller
{
    public function index()
    {
        try{
            $menuList = Menu::whereNull('parent_id')->get();
            $menus = Menu::paginate(5);
            
            return view('admin.menu', compact('menuList','menus'));

        }catch(\Exception $e){
            return abort(404, $e->getMessage());
        }

    }

    public function addMenu(Request $request)
    {
         
        try{
                Menu::create($request->all()); 
                return response()->json([
                    'msg'=> "Menu created",
                    'success'=> true
                ]);


        }catch(\Exception $e){
            // return abort(403, "Something went wrong");
            return response()->json([
                    'msg'=> $e->getMessage(),
                    'success'=> false
                ]);
        }
    }

    public function deleteMenu($id)
    {
        try{

            $menu = Menu::find($id);
            $menu->delete();

            return  redirect()->back()->with('success', 'Deleted successfully');

        }catch(\Exception $e){
            return response()->json([
                'success'=> false,
                'msg'=> $e->getMessage()
            ]);
        }
    }

    public function editMenu($id)
    {
        try{
            return true;
        }catch(\Exception $e){
            return abort(403, $e->getMessage());
        }
    }


    public function updateMenu(Request $request)
    {
         try{

                $validator = Validator::make($request->all(), [
                    'name' => 'required'
                ]);
             
                $menu = Menu::find($request->id);

                // dd($menu, $request->id);
                
                if(!$menu){
                    return abort('403', 'Menu record not found');
                }

                $menu->update([
                    'name'=> $request->name,
                    'url'=> $request->url,
                    'position'=>  $request->position,
                    'is_external'=> $request->is_external,
                    'parent_id'=> $request->parent_id
                ]);
                
                return response()->json([
                    'msg'=> "Menu updated   ",
                    'success'=> true
                ]);


        }catch(\Exception $e){
            // return abort(403, "Something went wrong");
            return response()->json([
                    'msg'=> $e->getMessage(),
                    'success'=> false
                ]);
        }
    }
    
    
}
