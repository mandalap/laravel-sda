<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeveloperResource\Pages;
use App\Filament\Resources\DeveloperResource\RelationManagers;
use App\Models\Developer;
use App\Models\Member;
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

class DeveloperResource extends Resource
{
    protected static ?string $title = 'Developer';
    protected static ?string $model = Developer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Developer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('member_id')
                ->label('Member')
                ->options(Member::all()->pluck('nama', 'id'))
                ->searchable()
                ->required(),

                Forms\Components\TextInput::make('nama')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Nama Developer'),

                Forms\Components\TextInput::make('telepon')
                ->required()
                ->numeric()
                ->unique(ignoreRecord: true)
                ->minLength(9),

                Forms\Components\TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

                Forms\Components\FileUpload::make('thumbnail')
                ->required()
                ->image()
                ->optimize('webp'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('member.nama')
                ->label('Nama Member')
                ->formatStateUsing(fn ($state, $record) => $record->member->nama ?? 'No Member')
                ->sortable()
                ->searchable(),

                TextColumn::make('nama')
                ->label('Nama Developer')
                ->sortable()
                ->searchable(),

                TextColumn::make('telepon')
                ->sortable()
                ->searchable(),

                TextColumn::make('email')
                ->sortable()
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
            'index' => Pages\ListDevelopers::route('/'),
            'create' => Pages\CreateDeveloper::route('/create'),
            'edit' => Pages\EditDeveloper::route('/{record}/edit'),
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
