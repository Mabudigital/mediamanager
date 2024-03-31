<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use Ladumor\OneSignal\OneSignal;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Redirect;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PushNotification $PushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PushNotification $PushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PushNotification $PushNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PushNotification $PushNotification)
    {
        //
    }

    public function send($id)
    {
        $PushNotification = PushNotification::find($id);
        $fields['include_player_ids'] = ['bc5934a3-41a1-4277-bfb7-7ec2435dcc38'];
        //$fields['included_segments'] = ['All'];
        $fields['headings'] = array(
            "en" => $PushNotification['title'],
        );
        $fields['contents'] = array(
            "en" => $PushNotification['content'],
        );

        $currentURL = request()->getSchemeAndHttpHost();

        $fields['big_picture'] =  $currentURL.'/'.$PushNotification['image'];
        $fields['ios_attachments'] =  array("id1" => $currentURL.'/'.$PushNotification['image'],);
        $fields['web_url'] =  $PushNotification['webLink'];
        $fields['app_url'] = $PushNotification['appLink'];
        //$fields['send_after'] = Carbon::parse($this->date)->format('Y-m-d H:i:s','America/Puerto_Rico', 'UTC').' GMT-400';
        $fields['isAndroid'] = $PushNotification['android'] ? true : false;
        $fields['isIos'] = $PushNotification['ios'] ? true : false;
        $fields['isChromeWeb'] = $PushNotification['chromeweb'] ? true : false;
        $fields['isChrome'] = $PushNotification['chrome'] ? true : false;
        $fields['isFirefox'] = $PushNotification['firefox'] ? true : false;
        $fields['isSafari'] = $PushNotification['safari'] ? true : false;

        $PushNotificationID = OneSignal::sendPush($fields);
        $PushNotification->sent = 1;
        $PushNotification->notification_id = $PushNotificationID['id'];
        $PushNotification->save();

        Notification::make()
            ->title('Sent successfully')
            ->success()
            ->send();
    
        return Redirect::back();
    }

    public function sendFromPodcast($id)
    {
        $podcast = Audio::find($id);
        $title = $podcast->PushNotification_title;
        $content = $podcast->PushNotification_content;
        $image = $podcast->image;
        $currentURL = request()->getSchemeAndHttpHost();
        $url = 'https://redentor104fm.com/playlists/playlist/'.$podcast->playlist_id;
        //$url = $currentURL.'/playlist-embed/'.$podcast->playlist_id.'/'.$podcast->id;
        //$currentURL = request()->getSchemeAndHttpHost();
        $pushTitle = '';
        if($title == ''){
            $pushTitle = '¡NUEVO PODCAST DISPONIBLE!';
        } else {
            $pushTitle = $title;
        }

        $pushMessage = '';
        if($content == ''){
            $pushMessage = 'Escucha '.$podcast->title.' en '.$podcast->playlist->title.' de '.$podcast->artist.' en Redentor.';
         }else{
            $pushMessage = $content;
         }

         $fields['include_player_ids'] = ['bc5934a3-41a1-4277-bfb7-7ec2435dcc38'];
         //$fields['included_segments'] = ['All'];
         $fields['headings'] = array(
            "en" => $pushTitle,
        );
        $fields['contents'] = array(
                "en" =>$pushMessage,
        );
        /***** PushNotification fields ****/
        $fields['big_picture'] =  $currentURL.'/'.$image;
        $fields['ios_attachments'] =  array("id1" => $currentURL.'/'. $image,);
        $fields['web_url'] =  $url;
        $fields['app_url'] = $url;
        $fields['isAndroid'] = true;
        $fields['isIos'] = true;
        $fields['isChromeWeb'] = true;
        $fields['isChrome'] = true;
        $fields['isFirefox'] = true;
        $fields['isSafari'] = true;
        
        /****** PushNotification database ******/
       /* $PushNotification = new PushNotification;
        $PushNotification->sent = 1;
        $PushNotification->title = $pushTitle;
        $PushNotification->content = $pushMessage;
        $PushNotification->image = $image;
        $PushNotification->date = now();
        $PushNotification->webLink = $url;
        $PushNotification->appLink = $url;
        $PushNotification->android = true;
        $PushNotification->ios = true;
        $PushNotification->chrome = true;
        $PushNotification->chromeweb = true;
        $PushNotification->firefox = true;
        $PushNotification->safari = true;*/
        
        //$PushNotification->save();
        //dd($PushNotification);
        $pushNotification = PushNotification::find($id);


        $PushNotificationID = OneSignal::sendPush($fields);
        //$PushNotification->notification_id = $PushNotificationID;
        Notification::make()
        ->title('Sent successfully')
        ->success()
        ->send();

        return Redirect::back();
    }
}
