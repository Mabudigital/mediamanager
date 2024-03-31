<?php

namespace App\Filament\Resources\AudioResource\Pages;

use Filament\Actions;
use App\Models\Playlist;
use App\Filament\Resources\AudioResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAudio extends CreateRecord
{
    protected static string $resource = AudioResource::class;
    
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
       // $data = $this->form->getState();
        $title = $data['title'];
        $artist = $data['artist'];
        $playlistId = $data['playlist_id'];
        $playlist = Playlist::find($playlistId);
        if( $data['notification_content'] == ''){
                  $data['notification_content'] = "Escucha {$title} en el podcast {$playlist->title} de {$artist} en Redentor. ";
        }
        
        return $data;
    }
}
