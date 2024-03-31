<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Programming;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProgrammingResource\Pages;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use App\Filament\Resources\ProgrammingResource\RelationManagers;


class ProgrammingResource extends Resource
{
    protected static ?string $model = Programming::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Programming';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('host')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\ViewField::make('image')
                    ->id('image_1')
                    ->hidden(fn(string $operation) => $operation === "view")
                    ->view('filament.forms.components.lfm-button')
                    ->extraAttributes(['type' => 'image', 'directory' => '/programming' ]),
                    Forms\Components\ViewField::make('image')->visible(fn(string $operation) => $operation === "view")->view('filament.forms.components.file-preview')->extraAttributes(['type' => 'image' ]),

                    Flatpickr::make('time_start')->time()->use24hr(false),
                    Flatpickr::make('time_end')->time()->use24hr(false),
                Forms\Components\Select::make('day')
                    ->required()
                    ->options([
                        'Domingos' => 'Domingos',
                        'Lunes' => 'Lunes',
                        'Martes' => 'Martes',
                        'Miércoles' => 'Miércoles',
                        'Jueves' => 'Jueves',
                        'Viernes' => 'Viernes',
                        'Sábados' => 'Sábados',
                        
                    ]),
                Forms\Components\Select::make('week')
                    ->required()
                    ->options([
                        '1' => 'Primera',
                        '2' => 'Segunda',
                        '3' => 'Tercera',
                        '4' => 'Cuarta',
                        '5' => 'Quinta',
                    ]),
                ])->columns([
                        'sm' => 1,
                        'lg' =>2
                   
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('host')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('time_start')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_end')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day')
                    ->searchable(),
                Tables\Columns\TextColumn::make('week')
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
                fn (Model $record): string => ProgrammingResource::getUrl('view', ['record' => $record]),
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
            'index' => Pages\ListProgrammings::route('/'),
            'create' => Pages\CreateProgramming::route('/create'),
            'view' => Pages\ViewProgramming::route('/{record}'),
            'edit' => Pages\EditProgramming::route('/{record}/edit'),
        ];
    }
}
