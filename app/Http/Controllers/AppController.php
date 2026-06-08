<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\AppData;
use App\Http\Requests\AppDataRequest;

class AppController extends Controller
{
    public function index()
    {
        $appData = AppData::first();
        // dd($appData);
        return view('admin.dashboard', compact('appData'));
    
    }

    public function save(AppDataRequest $appDataRequest)
    {
        try{

            AppData::updateOrCreate([
                'id'=> $appDataRequest->id
            ],
            
                $appDataRequest->all()
            );
            
            return redirect()->back()->with('success', "App data is created successfully.");
        }catch(\Exception $e){
            return abort(403, $e->getMessage());
        }
        
    }
}
