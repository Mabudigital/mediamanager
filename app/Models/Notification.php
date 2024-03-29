<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'notifications';
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'date',
        'internalLink',
        'externalLink',
        'webLink',
        'appLink',
        'android',
        'ios',
        'chrome',
        'chromeweb',
        'firefox',
        'safari',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'sent' => 'boolean',
        'android' => 'boolean',
        'ios' => 'boolean',
        'chrome' => 'boolean',
        'chromeweb' => 'boolean',
        'firefox' => 'boolean',
        'safari' => 'boolean',
        //'date' => 'datetime',
    ];
}
