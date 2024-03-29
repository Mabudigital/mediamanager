<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

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
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('uploads/notifications')
                    ->preserveFilenames(),
                Forms\Components\TextInput::make('date')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('internalLink')
                    ->maxLength(255),
                Forms\Components\TextInput::make('externalLink')
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('internalLink')
                    ->searchable(),
                Tables\Columns\TextColumn::make('externalLink')
                    ->searchable(),
                Tables\Columns\TextColumn::make('webLink')
                    ->searchable(),
                Tables\Columns\TextColumn::make('appLink')
                    ->searchable(),
                Tables\Columns\IconColumn::make('android')
                    ->boolean(),
                Tables\Columns\IconColumn::make('ios')
                    ->boolean(),
                Tables\Columns\IconColumn::make('chrome')
                    ->boolean(),
                Tables\Columns\IconColumn::make('chromeweb')
                    ->boolean(),
                Tables\Columns\IconColumn::make('firefox')
                    ->boolean(),
                Tables\Columns\IconColumn::make('safari')
                    ->boolean(),
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
