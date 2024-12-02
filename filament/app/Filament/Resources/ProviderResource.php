<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderResource\Pages;
use App\Filament\Resources\ProviderResource\RelationManagers\ProductsRelationManager;
use App\Models\Provider;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nombre')->required(),
                TextInput::make('cif')->label('CIF')->required(),
                TextInput::make('address')->label('Dirección')->required(),
                TextInput::make('zip_code')->label('Código Postal')->required(),
                Textarea::make('description')->label('Descripción')->required(),
                Select::make('category_id')->label('Categoría')->options(Category::all()->pluck('name', 'id'))->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->sortable()->searchable(),
                TextColumn::make('description')->label('Descripcion')->sortable()->searchable(),
                TextColumn::make('cif')->label('CIF')->sortable()->searchable(),
                TextColumn::make('address')->label('Dirección')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('zip_code')->label('Código Postal')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->label('Creado')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Actualizado')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
        ];
    }
}
