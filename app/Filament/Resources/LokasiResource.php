<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LokasiResource\Pages;
use App\Filament\Resources\LokasiResource\RelationManagers;
use App\Models\Lokasi;
use App\Models\Province;
use App\Models\Regency;
use Filament\Forms;
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

class LokasiResource extends Resource
{
    protected static ?string $title = 'Lokasi';
    protected static ?string $model = Lokasi::class;
    protected static ?string $navigationLabel = 'Lokasi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('province_id')
                    ->label('Province')
                    ->options(Province::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('regency_id')
                    ->label('Regency')
                    ->options(function (callable $get) {
                        // Mengambil ID provinsi yang dipilih
                        $provinceId = $get('province_id');
                        if ($provinceId) {
                            // Mengambil kabupaten sesuai dengan provinsi yang dipilih
                            return Regency::where('province_id', $provinceId)->pluck('name', 'id');
                        }
                        return [];
                    })
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Mengambil nama berdasarkan ID yang dipilih dan menghasilkan slug dari nama tersebut
                        $name = Regency::find($state)?->name; // Mengambil nama berdasarkan ID
                        $set('slug', Str::slug($name)); // Membuat slug dari nama
                    })
                    ->unique(ignoreRecord: true)
                    ->required(),



                Forms\Components\TextInput::make('slug')

                    ->label('Slug'),

                Forms\Components\FileUpload::make('thumbnail')
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
                TextColumn::make('province.name')
                ->searchable()
                ->label('Propinsi'),

                TextColumn::make('regency.name')
                ->searchable()
                ->label('Kabupaten/Kota'),

                ImageColumn::make('thumbnail'),
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
            'index' => Pages\ListLokasis::route('/'),
            'create' => Pages\CreateLokasi::route('/create'),
            'edit' => Pages\EditLokasi::route('/{record}/edit'),
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
