

<div class="mx-auto text-center w-48">
    
   @if(pathinfo(url($getState()))['extension'] == 'jpg' || pathinfo(url($getState()))['extension'] == 'png')
        <img src="{{ url($getState()) }}" class="p-4 w-24 h-24" />
    @else
     <video src="{{  url($getState()) }}" controls />
    @endif 
   
</div>
