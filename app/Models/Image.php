<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'program',
        'event',
        'artist',
        'date',
        'url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function setUrlAttribute($value)
    {

        $attribute_name = "url";
        $disk = "uploads";
        $destination_path = "images";
        $name = $this->title;

        $this->uploadFileToDisk($value, $attribute_name, $name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }


    public function imagePreviewer(){
        return '<img src="'.url("/uploads/{$this->url}").'" style="height:240px;width:auto;" />';
    }

}
