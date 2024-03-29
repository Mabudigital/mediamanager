@php
$audio = $this->data['audio'];
$video = $this->data['video'];
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    :extra-attributes="$getExtraAttributes()['type']"
>

       <div class="mb-4">
            @if ($image != null && $getExtraAttributes()['type'] == 'image')
                <img class="max-h-48 max-w-48 rounded-lg mb-4" src="{{$image}}"/>
                <div class="input-group flex">
                    <span class="input-group-btn inline-flex">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" style="cursor: pointer"
                            class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-l-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                            Select
                           
                        </a>
                    </span>
                   
                    <input id="thumbnail"  name="{{ $getStatePath() }}" wire:model.defer="{{ $getStatePath() }}" class="filament-forms-input block w-full transition duration-75 rounded-r-lg shadow-sm outline-none focus:ring-1 focus:ring-inset disabled:opacity-70 dark:bg-gray-700 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:focus:border-primary-500"
                        type="text" />
                    @error('{{ $getStatePath() }}') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div  id="holder" style="margin-top:15px;max-height:100px;" ></div>
            @endif
            @if ($audio != null && $getExtraAttributes()['type'] == 'file')
                <audio src="{{$audio}}" controls />
                <div class="input-group flex">
                    <span class="input-group-btn inline-flex">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" style="cursor: pointer"
                            class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-l-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                            Select
                           
                        </a>
                    </span>
                   
                    <input id="thumbnail" name="{{ $getStatePath() }}" wire:model.defer="{{ $getStatePath() }}" class="filament-forms-input block w-full transition duration-75 rounded-r-lg shadow-sm outline-none focus:ring-1 focus:ring-inset disabled:opacity-70 dark:bg-gray-700 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:focus:border-primary-500"
                        type="text" />
                    @error('{{ $getStatePath() }}') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
            
            
        </div>
</x-dynamic-component>

@push('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>

        $('#lfm').filemanager('{{$getExtraAttributes()['type']}}');
        var route_prefix = "/laravel-filemanager";
        $('#lfm').filemanager('{{$getExtraAttributes()['type']}}', {
            prefix: route_prefix
        });

        var element = document.getElementById('thumbnail');

       $('#thumbnail').on('change', function() {
            @this.set('{{ $getStatePath() }}', element.value);
        });

    </script>
@endpush
