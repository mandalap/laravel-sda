<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgencyResource\Pages;
use App\Filament\Resources\AgencyResource\RelationManagers;
use App\Models\Agency;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgencyResource extends Resource
{
    protected static ?string $model = Agency::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Agency';
    protected static ?string $title = 'Agency';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('member_id')
                ->label('Member')
                ->options(Member::all()->pluck('nama', 'id'))
                ->searchable()
                ->unique(ignoreRecord: true)
                ->required(),

                Select::make('sapaan')
                ->options([
                    'Pak' => 'Pak',
                    'Bu' => 'Bu',
                    'Bang' => 'Bang',
                    'Kak' => 'Kak',
                ])
                ->label('Sapaan')
                ->required(),

                Forms\Components\TextInput::make('nama')
                ->required(),

                Forms\Components\TextInput::make('telepon')
                ->required()
                ->numeric()
                ->unique(ignoreRecord: true)
                ->minLength(9),

                Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

                Radio::make('gender')
                ->options([
                    'L' => 'Laki-Laki',
                    'P' => 'Perempuan',
                ])
                ->required(),

                DatePicker::make('tanggal_lahir')
                ->native(false)
                ->displayFormat('d/m/Y'),

                Forms\Components\TextInput::make('agency_code')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('ID SDA'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('member.nama')
                ->label('Member Name')
                ->formatStateUsing(fn ($state, $record) => $record->member->nama ?? 'No Member')
                ->sortable()
                ->searchable(),

                TextColumn::make('sapaan')
                ->sortable()
                ->searchable(),

                TextColumn::make('telepon')
                ->searchable(),

                TextColumn::make('email')
                ->searchable(),

                TextColumn::make('gender')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'L' => 'success',
                    'P' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                    default => $state,
                })
                ->sortable()
                ->searchable(),

                TextColumn::make('tanggal_lahir')
                ->formatStateUsing(fn ($state) => strtoupper(\Carbon\Carbon::parse($state)->format('d M Y')))
                ->sortable()
                ->searchable(),

                TextColumn::make('agency_code')
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
            'index' => Pages\ListAgencies::route('/'),
            'create' => Pages\CreateAgency::route('/create'),
            'edit' => Pages\EditAgency::route('/{record}/edit'),
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
