<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'playlist_id',
        'title',
        'image',
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
        'playlist_id' => 'integer',
    ];

    public function playlist()
    {
        return $this->belongsTo(\App\Models\Playlist::class);
    }

   /* public function setUrlAttribute($value)
    {
        $attribute_name = "url";
        $disk = "uploads";
        $destination_path = "videos";
        $name = $this->title;

        $this->uploadFileToDisk($value, $attribute_name, $name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }*/

   /*public function setImageAttribute($value)
    {

        $attribute_name = "image";
        $disk = "uploads";
        $destination_path = "image";
        $name = $this->title;

        $this->uploadFileToDisk($value, $attribute_name, $name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }*/

   /* public function imagePreviewer(){
        return '<img src="'.url("/uploads/{$this->image}").'" style="height:240px;width:auto;" />';
    }

    public function videoPlayer(){
        return '<video width="320" height="240" controls>
        <source src="'.url("/uploads/{$this->url}").'" type="video/mp4">
      Your browser does not support the video tag.
      </video>';
    }*/
}
