<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Radio;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RadioResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use App\Filament\Resources\RadioResource\RelationManagers;

class RadioResource extends Resource
{
    protected static ?string $model = Radio::class;

    protected static ?string $navigationIcon = 'heroicon-o-signal';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('streaming_url')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alt_streaming_url')
                            ->maxLength(255),
                        Forms\Components\ViewField::make('image')
                        ->id('image_1')
                        ->hidden(fn(string $operation) => $operation === "view")
                        ->view('filament.forms.components.lfm-button')
                        ->extraAttributes(['type' => 'image', 'directory' => '/radios' ]),
                        Forms\Components\ViewField::make('image')->visible(fn(string $operation) => $operation === "view")->view('filament.forms.components.file-preview')->extraAttributes(['type' => 'image' ]),

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
                Tables\Columns\TextColumn::make('streaming_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alt_streaming_url')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->size(100),
                Tables\Columns\ViewColumn::make('image')->view('filament.columns.image-video-toggle'),
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
            ])
            ->recordUrl(
                fn (Model $record): string => RadioResource::getUrl('view', ['record' => $record]),
            )
            ->striped()
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
            'index' => Pages\ListRadios::route('/'),
            'create' => Pages\CreateRadio::route('/create'),
            'view' => Pages\ViewRadio::route('/{record}'),
            'edit' => Pages\EditRadio::route('/{record}/edit'),
        ];
    }
}
