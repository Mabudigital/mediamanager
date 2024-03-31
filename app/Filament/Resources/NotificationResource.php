<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PushNotification;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Ladumor\OneSignal\OneSignal;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NotificationResource\Pages;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use App\Filament\Resources\NotificationResource\RelationManagers;

class NotificationResource extends Resource
{
    protected static ?string $model = PushNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\ViewField::make('image')
                    ->id('image_1')
                    ->hidden(fn(string $operation) => $operation === "view")
                    ->view('filament.forms.components.lfm-button')
                    ->extraAttributes(['type' => 'image', 'directory' => '/notificaions' ]),
                    Forms\Components\ViewField::make('image')->visible(fn(string $operation) => $operation === "view")->view('filament.forms.components.file-preview')->extraAttributes(['type' => 'image' ]),
            
                    Flatpickr::make('date')->enableTime()->use24hr(false),
                Forms\Components\TextInput::make('webLink')
                    ->maxLength(255),
                Forms\Components\TextInput::make('appLink')
                    ->maxLength(255),
                Forms\Components\Toggle::make('android')
                    ->required(),
                Forms\Components\Toggle::make('ios')
                    ->required(),
                Forms\Components\Toggle::make('chrome')
                    ->required(),
                Forms\Components\Toggle::make('chromeweb')
                    ->required(),
                Forms\Components\Toggle::make('firefox')
                    ->required(),
                Forms\Components\Toggle::make('safari')
                    ->required(),
                ])->Columns([
                    'sm' => 1,
                    'lg' => 2,
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('sent')
                    ->boolean(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                    Tables\Columns\ViewColumn::make('image')->view('filament.columns.image-video-toggle'),
                Tables\Columns\TextColumn::make('date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('webLink')
                    ->searchable()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('appLink')
                    ->searchable()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('android')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('ios')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('chrome')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('chromeweb')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('firefox')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('safari')
                    ->boolean()
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->recordUrl(
                fn (Model $record): string => NotificationResource::getUrl('view', ['record' => $record]),
            )
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('Send Notificaion')
                ->label(function (Model $record): string {
                    if($record->sent == true){
                        return 'Re-send';
                    }
                   else {
                    return 'Send Notificaion';
                   }
                } )
                ->icon('heroicon-o-bell-alert')
                ->requiresConfirmation()
                ->url(fn (Model $record): string => route('sendNotification', ['id' => $record->id])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'view' => Pages\ViewNotification::route('/{record}'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        
       // $stats = function (PushNotification $record): array { return OneSignal::getNotification($record->notification_id)['platform_delivery_stats'];};
      
       return $infolist
            ->schema([
                InfoLists\Components\Section::make()
                ->schema([
                Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('content'),
                Infolists\Components\ViewEntry::make('image')->view('filament.columns.image-video-toggle'),
                
                    
                
                ]) 
            ]);
    }// OneSignal::getNotification('ec16972c-d191-415f-8467-69bceceabb2c')['platform_delivery_stats']
}
