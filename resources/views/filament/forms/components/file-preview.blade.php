@php
 $image = null;
 $audio = null;
 $video = null;   

 if($this->data && !empty($this->data['image']))
 {
    $image = $this->data['image'];
 }
 if($this->data && !empty($this->data['url']))
 {
    $audio = $this->data['url'];
    $video = $this->data['url'];
 }
 /*if($this->data && !empty($this->data['video']))
 {
    $video = $this->data['video'];
 }*/
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :extra-attributes="$getExtraAttributes()['type']"
>
<div class="mb-4"> 
    @if ( $getExtraAttributes()['type'] == 'image' && $image != null )
        <img class="max-h-48 max-w-48 rounded-lg mb-4" src="{{$image}}"/>
    @endif

    @if ( $getExtraAttributes()['type'] == 'audio' && $audio != null )
        <audio src="{{$audio}}" controls class="max-h-48 max-w-48 rounded-lg mb-4" ></audio>
    @endif

    @if ( $getExtraAttributes()['type'] == 'video' && $video != null )
        <video src="{{$video}}" controls class="max-h-48 max-w-48 rounded-lg mb-4" ></video>
    @endif
</div>
</x-dynamic-component>

