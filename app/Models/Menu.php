<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'url',
        'is_external',
        'position',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function getFullUrlAttribute($url)
    {
        if($this->is_external){
            return $this->url;   
        }

        return url($this->url);

    }
}
