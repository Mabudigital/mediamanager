<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Audio;
use Filament\Forms\Get;
use App\Models\Playlist;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AudioResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use App\Filament\Resources\AudioResource\RelationManagers;

class AudioResource extends Resource
{
    protected static ?string $model = Audio::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';
    protected static ?string $navigationLabel = 'Audios';
    protected static ?int $navigationSort = 2;



    public static function form(Form $form): Form
    {   
       
        return $form
        ->schema([
            Forms\Components\Section::make()
            ->schema([
                Forms\Components\Select::make('playlist_id')
                ->relationship(name: 'playlist', titleAttribute: 'title')
                ->live()
                
                ->afterStateUpdated(function ($state, callable $set) {
                    $playlist =  Playlist::find($state);
                    $set('artist',$playlist->host);
                }),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(),
                Forms\Components\ViewField::make('image')->id('image_1')->view('filament.forms.components.lfm-button')->extraAttributes(['type' => 'image','directory'=>'audios']),    
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('program')
                    ->maxLength(255),
                Forms\Components\TextInput::make('event')
                    ->maxLength(255),
                Forms\Components\TextInput::make('artist'),
                Forms\Components\DatePicker::make('date'),
               Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('featured')
                    ->required(),
                Forms\Components\TextInput::make('notificationTitle')
                    ->default('¡NUEVO PODCAST DISPONIBLE!')
                    ->hint('Solo llene si desea cambiar este mensaje.')
                    ->maxLength(50),
                Forms\Components\Textarea::make('notificationContent')
                    ->hint('Si se deja vacío se mostrara como: Escucha {{$title}} - {{$thisplaylist}} de {{$artist}} en Redentor. Solo llene si desea cambiar este mensaje.')
                    ->maxLength(250),
            ])->Columns([
                'sm' => 1,
                'lg' => 2
            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('playlist.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('artist')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('date')
                ->sortable()
                ->searchable(),
               /* Tables\Columns\TextColumn::make('url')->searchable(),*/
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
               // Tables\Columns\TextColumn::make('notificationContent')->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at','desc')
            ->filters([
                Tables\Filters\Filter::make('is_featured')->query(fn (Builder $query): Builder => $query->where('featured', true)),
                Tables\Filters\SelectFilter::make('playlist')
                ->relationship(name: 'playlist', titleAttribute: 'title')
                ->preload()
                ->multiple(),
                Tables\Filters\Filter::make('Added at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                        )
                        ->when(
                            $data['until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                        );
                    }),
                Tables\Filters\TrashedFilter::make(),
            ])->filtersFormColumns(4)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAudio::route('/'),
            'create' => Pages\CreateAudio::route('/create'),
            'edit' => Pages\EditAudio::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
