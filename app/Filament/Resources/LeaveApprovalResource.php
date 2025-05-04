<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveApprovalResource\Pages;
use App\Filament\Resources\LeaveApprovalResource\RelationManagers;
use App\Models\LeaveApproval;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveApprovalResource extends Resource
{
    protected static ?string $model = LeaveApproval::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Persetujuan Cuti';
    protected static ?string $navigationGroup = 'Manajemen Karyawan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('leave_id')
                    ->relationship('leave', 'reason'),
                Forms\Components\TextInput::make('status')
                    ->label('Status Cuti'),

                // Forms\Components\Select::make('approver_id')
                //     ->relationship('approver', 'name'),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('leave.reason')
                    ->label('Alasan Cuti')
                    ->sortable(),
                Tables\Columns\TextColumn::make('leave.user.name')
                    ->label('Nama Pegawai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('approver.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLeaveApprovals::route('/'),
            //'create' => Pages\CreateLeaveApproval::route('/create'),
            'view' => Pages\ViewLeaveApproval::route('/{record}'),
            'edit' => Pages\EditLeaveApproval::route('/{record}/edit'),
        ];
    }
}
