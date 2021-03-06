<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','photo','status','is_paid','image'];
    public $timestamps = false;

    public function subs()
    {
    	return $this->hasMany('App\Model\Subcategory')->where('status','=',1);
    }


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
    
    public function blogs()
    {
    	return $this->hasMany('App\Model\Blog','category_id');
    }

    
}
