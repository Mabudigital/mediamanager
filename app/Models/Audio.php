<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use HasFactory,SoftDeletes;

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
        'featured',
        'notification_title',
        'notification_content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'playlist_id' => 'integer',
        'date' => 'date',
        'featured' => 'boolean',
    ];

    public function playlist()
    {
        return $this->belongsTo(\App\Models\Playlist::class);
    }

   /* public function setUrlAttribute($value)
    {

        $attribute_name = "url";
        $disk = "uploads";
        $destination_path = "audios";
        $name = $this->title;

        $this->uploadFileToDisk($value, $attribute_name, $name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }*/

  /*  public function setImageAttribute($value)
    {

        $attribute_name = "image";
        $disk = "uploads";
        $destination_path = "image";
        $search = [' ','á','é','í','ó','ú'];
        $replace = ['-','a','e','i','o','u'];
        $name = str_replace($search,$replace,$this->title);

        $this->uploadFileToDisk($value, $attribute_name, $name, $disk, $destination_path);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
  }*/

    public function imagePreviewer(){
        return '<img src="'.url("{$this->image}").'" style="height:240px;width:auto;" />';
    }

    public function audioPlayer(){
        return '<audio controls>
        <source src="'.url("{$this->url}").'" type="audio/mp3">
      Your browser does not support the audio tag.
      </audio>';
    }


    public function sendNotification($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="send-podcast-notification/'.$this->id.'" data-toggle="tooltip" title="send notification."><i class="la la-bell"></i> Send Notification</a>';
    }

    public function share($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="/share/'.$this->id.'" data-toggle="tooltip" title="share podcast."><i class="la la-share"></i> Share</a>';
    }

    public function isFeatured($crud = false)
    {
      if($this->featured == true){
        return '<i class="la la-check"></i>';
      }

    }

}
