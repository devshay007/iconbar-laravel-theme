<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\UserActionsBy;

class Hospital extends Model
{
    use UserActionsBy;
    public $table = 'm_orginfo';
    protected $primaryKey = 'hospid';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'updated_by'
    ]; // Not mandatory fileds when add from request.

}
