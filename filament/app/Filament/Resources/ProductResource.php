<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->label('Nombre del producto'),
            Textarea::make('description'),
            FileUpload::make('image_url')->label('URL de la imagen'),
            TextInput::make('price')
                ->numeric()
                ->label('Precio'),
            Select::make('currency_id')->relationship('currency', 'name'),
            Select::make('provider_id')->relationship('provider','name'),
            TextInput::make('stock')
                ->numeric()
                ->label('Stock'),
                Select::make('category_id')
                ->label('Categoría')
                ->options(Category::pluck('name', 'id'))  // Usando pluck en vez de all()
                ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
         TextColumn::make('name')
                ->label('Nombre')
                ->sortable()
                ->searchable(), // Permite buscar en este campo
         TextColumn::make('description')
                ->label('Descripción')
                ->limit(50), // Limita el texto a 50 caracteres
           ImageColumn::make('image_url')
                ->label('Imagen'), // Muestra la imagen
            TextColumn::make('price')
               ->sortable()
               ->toggleable(),
        TextColumn::make('stock')
                ->label('Stock')
                ->sortable(), // Permite ordenar por este campo
          TextColumn::make('category.name')
            ->label('Categoria'),
            TextColumn::make('currency.name')
            ->toggleable(),
            TextColumn::make('provider.name')
            ->sortable()
            ->toggleable(),
            TextColumn::make('status.name')
            ->sortable()
            ->toggleable(),
            TextColumn::make('created_at')
            ->dateTime()
            ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
            ->dateTime()
            ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            SelectFilter::make('currency_id')->relationship('currency','name'),
            SelectFilter::make('provider_id')->relationship('provider','name'),
            SelectFilter::make('status_id')->relationship('status','name'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    public static function getRelations(): array
    {
        return [
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
