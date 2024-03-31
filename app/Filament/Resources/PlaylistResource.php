<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Playlist;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PlaylistResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PlaylistResource\RelationManagers;

class PlaylistResource extends Resource
{
    protected static ?string $model = Playlist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                    Forms\Components\ViewField::make('image')
                    ->id('image_1')
                    ->hidden(fn(string $operation) => $operation === "view")
                    ->view('filament.forms.components.lfm-button')
                    ->extraAttributes(['type' => 'image', 'directory' => '/playlists' ]),
                    Forms\Components\ViewField::make('image')->visible(fn(string $operation) => $operation === "view")->view('filament.forms.components.file-preview')->extraAttributes(['type' => 'image' ]),
                Forms\Components\TextInput::make('host')
                    ->required()
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                    Tables\Columns\ViewColumn::make('image')->view('filament.columns.image-video-toggle'),
                Tables\Columns\TextColumn::make('host')
                    ->searchable(),
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
                fn (Model $record): string => PlaylistResource::getUrl('view', ['record' => $record]),
            )
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPlaylists::route('/'),
            'create' => Pages\CreatePlaylist::route('/create'),
            'view' => Pages\ViewPlaylist::route('/{record}'),
            'edit' => Pages\EditPlaylist::route('/{record}/edit'),
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
