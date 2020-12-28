<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

trait UserActionsBy
{
    protected static function bootUserActionsBy()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
            if (auth()->check()) {
                if (Schema::hasColumn($model->getTable(), 'created_by')){
                    $model->created_by =auth()->id();
                }
            }
            if (Schema::hasColumn($model->getTable(), 'stats_flag')){
                $model->stats_flag ='N';
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                if (Schema::hasColumn($model->getTable(), 'updated_by')){
                    $model->updated_by =auth()->id();
                }
            }
            if (Schema::hasColumn($model->getTable(), 'stats_flag')){
                $model->stats_flag ='M';
            }
        });

        static::deleting(function ($model) {
            if (auth()->check()) {
                if (Schema::hasColumn($model->getTable(), 'deleted_by')){

                    $model->deleted_by =auth()->id();
                }
            }
            if (Schema::hasColumn($model->getTable(), 'stats_flag')){
                $model->stats_flag ='D';
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
