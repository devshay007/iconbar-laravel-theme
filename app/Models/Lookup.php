<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\UserActionsBy;
use App\Models\Lookup;
class Lookup extends Model
{	
	use UserActionsBy;
	public $table = 'm_lookup';
	protected $primaryKey = 'lookupid';
	protected $dates = [
        'created_at',
        'updated_at'
    ];

	protected $fillable = [
		'keyname',
        'keyvalue',
        'hospid',
        'stats_flag',
        'created_at',
        'updated_at'
    ];

    public static function getLookupBykey($key) 
    {
        return Lookup::where('keyname',$key)->get();
    }
}