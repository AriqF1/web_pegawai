<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveResource\Pages;
use App\Filament\Resources\LeaveResource\RelationManagers;
use App\Models\Leave;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveResource extends Resource
{
    protected static ?string $model = Leave::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Cuti Pegawai';
    protected static ?string $navigationGroup = 'Manajemen Karyawan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->helperText('pilih pegawai')
                    ->relationship('user', 'name'),
                Forms\Components\DatePicker::make('start_date')
                    ->helperText('isikan tanggal mulai cuti')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->helperText('isikan tanggal berakhir cuti')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->helperText('isikan alasan cuti')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('leave_type_id')
                    ->helperText('pilih tipe cuti')
                    ->relationship('leaveType', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pegawai')
                    ->icon('heroicon-o-user')
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->icon('heroicon-o-calendar')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->icon('heroicon-o-calendar')
                    ->date(),
                Tables\Columns\TextColumn::make('leaveType.name')
                    ->label('Tipe Cuti'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil'),
                Tables\Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Cuti Pegawai')
                    ->modalDescription('Apakah Anda yakin ingin menghapus cuti pegawai ini?')
                    ->modalSubmitActionLabel('Hapus')
                    ->action(fn($record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLeaves::route('/'),
            'create' => Pages\CreateLeave::route('/create'),
            'edit' => Pages\EditLeave::route('/{record}/edit'),
        ];
    }
}
