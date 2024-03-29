

<div class="mx-auto text-center w-48">
    
   @if(pathinfo(url($getState()))['extension'] == 'jpg' || pathinfo(url($getState()))['extension'] == 'png')
        <img src="https://apps.wibxi.net{{ $getState() }}" width="100%" height="100%" />
    @else
     <video src="https://apps.wibxi.net{{ $getState() }}" controls />
    @endif 
   
</div>
