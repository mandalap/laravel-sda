<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('nama_project', 'id'))
                    ->searchable()
                    ->required(),

                    TextInput::make('code_product')
                    ->label('ID Product')
                    ->helperText('ID Product Harus Unik')
                    ->required()
                    ->suffixAction(
                        Action::make('generateCode')
                            ->icon('heroicon-m-arrow-path')
                            ->action(function ($set) {
                                $random = 'SDA-' . strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10));
                                $set('code_product', $random);
                            })
                        ),

                TextInput::make('nama_product')
                    ->label('Nama Product')
                    ->helperText('Masukkan nama blok A / B1')
                    ->required(),

                TextInput::make('panjang')
                    ->label('Panjang')
                    ->numeric()
                    ->required(),

                TextInput::make('lebar')
                    ->label('Lebar')
                    ->numeric()
                    ->required(),

                TextInput::make('luas')
                    ->label('Luas')
                    ->numeric()
                    ->required(),

                TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required(),

                TextInput::make('discount')
                    ->label('Diskon')
                    ->numeric()
                    ->required(),

                TextInput::make('fee')
                    ->label('Fee Marketing')
                    ->numeric()
                    ->required(),

                Select::make('pembayaran')
                    ->options([
                        'Cash' => 'Cash',
                        'Cash Tempo' => 'Cash Tempo',
                        'Kredit' => 'Kredit',
                    ])
                    ->required(),

                Select::make('status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Booking' => 'Booking',
                        'Pending' => 'Pending',
                        'Terjual' => 'Terjual',
                    ])
                    ->required(),

                Select::make('jenis')
                    ->options([
                        'Jual' => 'Jual',
                        'Sewa' => 'Sewa',
                        'Jual/Sewa' => 'Jual/Sewa',
                    ])
                    ->required(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('project.developer.nama')
                ->label('Developer')
                ->formatStateUsing(fn ($state, $record) => $record->project->developer->nama ?? 'No Developer')
                ->sortable()
                ->searchable(),

                TextColumn::make('project.nama_project')
                ->label('Project')
                ->formatStateUsing(fn ($state, $record) => $record->project->nama_project ?? 'No Project')
                ->sortable()
                ->searchable(),

                TextColumn::make('project.kategori.kategori')
                ->label('Kategori')
                ->formatStateUsing(fn ($state, $record) => $record->project->kategori->kategori ?? 'No Kategori')
                ->sortable()
                ->searchable(),

                TextColumn::make('nama_product')
                ->label('Nama Product')
                ->formatStateUsing(fn ($state, $record) => $record->nama_product ?? 'No Nama Product')
                ->searchable(),

                TextColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn ($state, $record) => $record->status ?? 'No Status')
                ->sortable()
                ->searchable(),

                TextColumn::make('harga')
                ->label('Harga')
                ->formatStateUsing(fn ($state, $record) =>
                    $record->harga && $record->diskon
                        ? number_format($record->harga - $record->diskon, 0, ',', '.')
                        : ($record->harga
                            ? number_format($record->harga, 0, ',', '.')
                            : 'No Harga'))
                ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
