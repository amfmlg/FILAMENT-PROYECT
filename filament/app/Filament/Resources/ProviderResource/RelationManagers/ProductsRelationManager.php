<?php

namespace App\Filament\Resources\ProviderResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nombre')->required(),
                TextInput::make('cif')->label('CIF')->required(),
                TextInput::make('address')->label('Dirección')->required(),
                TextInput::make('zip_code')->label('Código Postal')->required(),
                Textarea::make('description')->label('Descripción'),
                Select::make('category_id')
                    ->label('Categoría')
                    ->options(\App\Models\Category::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->sortable()->searchable(),
                TextColumn::make('description')->label('Descripción')->limit(50),
                ImageColumn::make('image_url')->label('Imagen'),
                TextColumn::make('price')->label('Precio')->sortable()->toggleable(),
                TextColumn::make('stock')->label('Stock')->sortable(),
                TextColumn::make('category.name')->label('Categoría'),
                TextColumn::make('currency.name')->label('Moneda')->toggleable(),
                TextColumn::make('provider.name')->label('Proveedor')->sortable()->toggleable(),
                TextColumn::make('status.name')->label('Estado')->sortable()->toggleable(),
                TextColumn::make('created_at')->label('Creado')->dateTime()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label('Actualizado')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('currency_id')->relationship('currency', 'name'),
                SelectFilter::make('provider_id')->relationship('provider', 'name'),
                SelectFilter::make('status_id')->relationship('status', 'name'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
