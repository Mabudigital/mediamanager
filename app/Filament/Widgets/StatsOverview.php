<?php

namespace App\Filament\Widgets;

use App\Models\Audio;
use App\Models\Image;
use App\Models\Video;
use App\Models\Playlist;
use App\Models\Programming;
use Illuminate\Support\Number;
use App\Models\PushNotification;
use Ladumor\OneSignal\OneSignal;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    
    protected function getStats(): array
    {
        
        $playlists = Playlist::all();
        $audios = Audio::all();
        $videos = Video::all();
        $images = Image::all();
        $programs= Programming::all();
        $notifications = PushNotification::all();
        return [
            Stat::make('Playlists', Number::format($playlists->count()))
                //->description('32k increase')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Audios', Number::format($audios->count()))
                //->description('7% increase')
                //->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Videos', Number::format($videos->count()))
                //->description('3% increase')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('amber'),
            Stat::make('Images', Number::format($images->count()))
                //->description('3% increase')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('cyan'),
            Stat::make('Programs', Number::format($programs->count()))
                //->description('3% increase')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('cyan'),
            Stat::make('Notifications Subscribers',Number::format(OneSignal::getDevices()['total_count']))->color('cyan'),
            Stat::make('Notifications Sent', Number::format(OneSignal::getNotifications()['total_count']))
                //->description('3% increase')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('cyan'),
            
        ];
    }
}
