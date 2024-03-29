<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programming extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'host',
        'image',
        'time_start',
        'time_end',
        'day',
        'week',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'day' =>'array',
        'week' => 'array',
    ];

    /*public function imagePreviewer(){
        return '<img src="'.url("{$this->image}").'" style="height:240px;width:auto;" />';
    }*/
}
