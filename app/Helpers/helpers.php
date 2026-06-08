<?php


use App\Models\admin\AppData;
use App\Models\Menu;
use App\Models\Category;



function getAppData($select)
{    
    $sendData = '';
    $appData = AppData::select($select)->first();

    if($appData)
    {
        $sendData = $appData->$select;
    }

    return   $sendData;
}

function getMenu($position)
{
    try{

       return Menu::where('position', $position)->whereNull('parent_id')->orderBy('id')->get();

    }catch(\Exception $e){
        return [];
    }
}

function getAllCategory()
{
    try{

       return Category::whereNull('parent_id')->orderBy('id')->get();

    }catch(\Exception $e){
        return [];
    }
}

function getCategoryName($parentId)
{
    try{
        return Category::where('id', $parentId)->first()->name;
    }catch(\Exception $e)
    {
        return [];
    }
}