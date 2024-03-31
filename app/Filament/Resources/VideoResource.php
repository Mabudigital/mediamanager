<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VideoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VideoResource\RelationManagers;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('program')
                    ->maxLength(255),
                Forms\Components\TextInput::make('event')
                    ->maxLength(255),
                Forms\Components\TextInput::make('artist')
                    ->maxLength(255),
                Forms\Components\TextInput::make('date')
                    ->maxLength(255),
                    Forms\Components\ViewField::make('url')
                    ->label('video')
                    ->visible(fn(string $operation) => $operation === "view")
                    ->view('filament.forms.components.file-preview')
                    ->extraAttributes(['type' => 'video' ]),
                    Forms\Components\ViewField::make('url')
                    ->label('video')
                        ->id('video_1')
                        ->hidden(fn(string $operation) => $operation === "view")
                        ->view('filament.forms.components.lfm-button')
                        ->extraAttributes(['type' => 'audio', 'directory' => '/videos' ]),
                ])->Columns([
                    'sm' => 1,
                    'lg'=>2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event')
                    ->searchable(),
                Tables\Columns\TextColumn::make('artist')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
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
                fn (Model $record): string => VideoResource::getUrl('view', ['record' => $record]),
            )
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
