<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Developer;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Kelompok;
use App\Models\Lokasi;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Fieldset::make('Detail')
                ->schema([
                    Select::make('developer_id')
                    ->label('Developer')
                    ->options(Developer::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),

                    Select::make('lokasi_id')
                    ->label('Lokasi')
                    ->options(Lokasi::all()->pluck('regency.name', 'id'))
                    ->searchable()
                    ->required(),

                    Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(Kategori::all()->pluck('kategori', 'id'))
                    ->searchable()
                    ->required(),

                    Select::make('jenis_id')
                    ->label('Jenis')
                    ->options(Jenis::all()->pluck('jenis', 'id'))
                    ->searchable()
                    ->required(),

                    Forms\Components\TextInput::make('nama_project')
                        ->reactive() // Penting: Membuat field kategori reaktif
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('slug', Str::slug($state)); // Memanggil mutator secara manual
                        })
                        // ->label('Nama Project')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->label('Tampilan'),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->nullable()
                        ->image()
                        ->optimize('webp'),

                    Textarea::make('alamat_project')
                    ->label('Alamat Lokasi')
                    ->rows(5)
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('video')
                    ->label('Link Video')
                    ->nullable(),

                    TextInput::make('google_maps')
                    ->label('Link Google Maps')
                    ->nullable(),

                    TextInput::make('latlang')
                    ->label('Lat-Lang Google Maps')
                    ->nullable(),

                    Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable(),

                    Select::make('sertifikat')
                    ->options([
                        'SHM' => 'SHM',
                        'SKT' => 'SKT',
                    ])
                    ->required(),

                    Select::make('status_sertifikat')
                    ->options([
                        'Siap Balik Nama' => 'Siap Balik Nama',
                        'Proses Pemecahan' => 'Proses Pemecahan',
                    ])
                    ->required(),

                    Select::make('transaksi')
                    ->options([
                        'Cash' => 'Cash',
                        'Cash Tempo' => 'Cash Tempo',
                        'Kredit' => 'Kredit',
                    ])
                    ->required(),

                    Select::make('kelompok_id')
                    ->label('Kelompok')
                    ->options(Kelompok::all()->pluck('kelompok', 'id'))
                    ->searchable()
                    ->required(),


                    Select::make('is_approved')
                    ->options([
                        'Pending' => 'Pending',
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->required(),
                ]),

                Fieldset::make('Photo')
                ->schema([

                    Forms\Components\Repeater::make('photos')
                    ->relationship('project_photos')
                    ->schema([
                        FileUpload::make('photo')
                        ->nullable()
                        ->image()
                        ->optimize('webp'),
                    ]),

                ]),

                Fieldset::make('Fasilitas')
                ->schema([

                    Forms\Components\Repeater::make('fasilitas')
                    ->relationship('project_fasilitas')
                    ->schema([
                        TextInput::make('fasilitas')->nullable(),
                    ]),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('developer.nama')
                ->label('Developer')
                ->formatStateUsing(fn ($state, $record) => $record->developer->nama ?? 'No Developer')
                ->sortable()
                ->searchable(),

                TextColumn::make('kategori.kategori')
                ->label('Kategori')
                ->formatStateUsing(fn ($state, $record) => $record->kategori->kategori ?? 'No Kategori')
                ->sortable()
                ->searchable(),

                TextColumn::make('lokasi.regency.name')
                ->label('Lokasi')
                ->formatStateUsing(fn ($state, $record) => $record->lokasi->regency->name ?? 'No Lokasi')
                ->sortable()
                ->searchable(),

                TextColumn::make('nama_project')
                ->label('Nama Project')
                ->searchable(),

                TextColumn::make('kelompok.kelompok')
                ->label('Kelompok')
                ->formatStateUsing(fn ($state, $record) => $record->kelompok->kelompok ?? 'No Kelompok')
                ->sortable()
                ->searchable(),

                ImageColumn::make('thumbnail'),

            ])
            ->filters([
                SelectFilter::make('kategori_id')
                ->label('Kategori')
                ->relationship('kategori', 'kategori'),

                SelectFilter::make('lokasi_id')
                ->label('Lokasi')
                ->options(function () {
                    return Lokasi::with('regency')
                        ->get()
                        ->pluck('regency.name', 'id') // Mengambil nama regency dan id lokasi
                        ->sort(); // Menyortir berdasarkan nama regency
                }),

                SelectFilter::make('developer_id')
                ->label('Developer')
                ->relationship('developer', 'nama'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
    }
}
