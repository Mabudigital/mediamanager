<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
      @foreach (OneSignal::getNotification($getRecord()['notification_id'])['platform_delivery_stats'] as $key => $stats)
      {{$key}}
       @foreach  ( $stats as $key2 => $item)
       {{$key2}} - {{$item}}
       @endforeach
      @endforeach
     
    </div>
</x-dynamic-component>
