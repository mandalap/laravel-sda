<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('sapaan')
                ->options([
                    'Pak' => 'Pak',
                    'Bu' => 'Bu',
                    'Bang' => 'Bang',
                    'Kak' => 'Kak',
                ]),

                Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('email')
                ->nullable()
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

                Forms\Components\TextInput::make('telepon')
                ->required()
                ->numeric()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

                Forms\Components\TextInput::make('password')
                ->required()
                ->password()
                ->maxLength(255),

                Radio::make('gender')
                ->options([
                    'L' => 'Laki-Laki',
                    'P' => 'Perempuan',
                ])
                ->required(),

                Forms\Components\TextInput::make('tempat_lahir')
                ->nullable()
                ->maxLength(255),

                DatePicker::make('tanggal_lahir')
                ->native(false)
                ->displayFormat('d/m/Y'),

                Forms\Components\TextInput::make('kota_id')
                ->nullable()
                ->label(__('Domisili'))
                ->maxLength(255),

                Forms\Components\Textarea::make('alamat')
                ->nullable()
                ->maxLength(255),

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
                TextColumn::make('sapaan'),

                TextColumn::make('nama')
                ->sortable()
                ->searchable(),

                TextColumn::make('email')
                ->icon('heroicon-m-envelope')
                ->searchable(),

                TextColumn::make('telepon')
                ->copyable()
                ->copyMessage('Telepon copied')
                ->copyMessageDuration(1500)
                ->icon('heroicon-m-phone')
                ->searchable(),

                TextColumn::make('status')
                ->searchable(),

                TextColumn::make('gender')
                ->searchable(),

                TextColumn::make('tempat_lahir')
                ->searchable(),

                TextColumn::make('tanggal_lahir')
                ->searchable(),

                TextColumn::make('kota_id')
                ->searchable(),

                TextColumn::make('alamat')
                ->searchable(),

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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
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
