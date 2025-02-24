<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Filament\Resources\KategoriResource\RelationManagers;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class KategoriResource extends Resource
{
    protected static ?string $title = 'Kategori';
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kategori';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Forms\Components\TextInput::make('kategori')
                    ->reactive() // Penting: Membuat field kategori reaktif
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state)); // Memanggil mutator secara manual
                    })
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->label('Tampilan'),

                Select::make('jenis')
                ->options([
                    'Jual' => 'Jual',
                    'Sewa' => 'Sewa',
                    'Jual/Sewa' => 'Jual/Sewa',
                ])
                ->required(),

                Radio::make('status')
                ->options([
                    'Aktif' => 'Aktif',
                    'Tidak Aktif' => 'Tidak Aktif',
                ])
                ->required(),

                Forms\Components\FileUpload::make('icon')
                ->nullable()
                ->image()
                ->optimize('webp'),

                ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('kategori')
                ->searchable(),

               TextColumn::make('status')
               ->sortable(),

                TextColumn::make('jenis')
                    ->sortable(),

                ImageColumn::make('icon'),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
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
