<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama Pegawai'),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique()
                    ->label('Email'),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->label('Alamat'),
                DatePicker::make('joining_date')
                    ->required()
                    ->label('Tanggal Bergabung'),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->label('No. Telepon'),
                FileUpload::make('photo')
                    ->required()
                    ->label('Foto Pegawai')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto Pegawai'),
                TextColumn::make('name')->label('Nama Pegawai'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('No. Telepon'),
                TextColumn::make('address')->label('Alamat'),
                TextColumn::make('joining_date')
                    ->label('Tanggal Bergabung')
                    ->date(),

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
