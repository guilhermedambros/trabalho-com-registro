<?php

namespace App\Http\Controllers\Traits;

trait RecordSignature
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {

            $model->modified_by = \Auth::user()->id;
        });

        static::creating(function ($model) {

            $model->created_by = \Auth::user()->id;
        });

        static::deleting(function ($model) {

            $model->deleted_by = \Auth::user()->id;
        });
    }

}