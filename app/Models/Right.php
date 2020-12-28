<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $table = 'm_rights';
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'title',
        'parent_id',
        'link',
        'status',
        'created_at',
        'updated_at'
    ];

    public function childs() {
        return $this->hasMany('App\Models\Right','parent_id','id');
    }

	public static function getMenuItems() 
    {
    	return Right::where('status',1)->where('parent_id',0)->get();
    }
}