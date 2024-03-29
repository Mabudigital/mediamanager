@php
 $image = null;
 $audio = null;
 $video = null;   

 if($this->data && !empty($this->data['image']))
 {
    $image = $this->data['image'];
 }
 if($this->data && !empty($this->data['audio']))
 {
    $audio = $this->data['audio'];
 }
 if($this->data && !empty($this->data['video']))
 {
    $video = $this->data['video'];
 }


@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    :extra-attributes="$getExtraAttributes()['type']"
>
       <div class="mb-4"> 
            @if ( $getExtraAttributes()['type'] == 'image' && $image != null )
                <img class="max-h-48 max-w-48 rounded-lg mb-4" src="{{$image}}"/>
            @endif

            @if ( $getExtraAttributes()['type'] == 'file' && $audio != null )
                <audio src="{{$audio}}" controls class="max-h-48 max-w-48 rounded-lg mb-4" ></audio>
            @endif

            @if ( $getExtraAttributes()['type'] == 'file' && $video != null )
                <video src="{{$video}}" controls class="max-h-48 max-w-48 rounded-lg mb-4" ></video>
            @endif

            <div class="input-group flex">
                    <span class="input-group-btn inline-flex">
                        <a id="lfm-{{$getId()}}" data-input="thumbnail-{{$getId()}}"
                            class="fi-btn fi-btn-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-l-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action cursor-pointer">
                            Select
                        </a>
                    </span>
                
                    <input id="thumbnail-{{$getId()}}" name="{{ $getStatePath() }}" wire:model.defer="{{ $getStatePath() }}" class="filament-forms-input block w-full transition duration-75 rounded-r-lg shadow-sm outline-none focus:ring-1 focus:ring-inset disabled:opacity-70 dark:bg-gray-700 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:focus:border-primary-500"
                        type="text" />
                    @error('{{ $getStatePath() }}') <span class="text-danger">{{ $message }}</span> @enderror
               
            </div>
                
        </div>
</x-dynamic-component>

@push('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{url('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

    <script>

        $('#lfm-{{$getId()}}').filemanager('{{$getExtraAttributes()['type']}}');
        var route_prefix = "{{url('/laravel-filemanager')}}";
        $('#lfm-{{$getId()}}').filemanager('{{$getExtraAttributes()['type']}}', {
            prefix: route_prefix
        });

        var element_{{$getId()}} = document.getElementById('thumbnail-{{$getId()}}');

       $('#thumbnail-{{$getId()}}').on('change', function() {
            @this.set('{{ $getStatePath() }}', element_{{$getId()}}.value);
        });
    </script>
@endpush
