<?php

namespace App\Filament\Resources\LeaveApprovalResource\Pages;

use App\Filament\Resources\LeaveApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;


class ViewLeaveApproval extends ViewRecord
{
    protected static string $resource = LeaveApprovalResource::class;
    protected static ?string $title = 'Detail Persetujuan Cuti';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Cuti')
                    ->description('Data utama pengajuan cuti')
                    ->schema([
                        TextEntry::make('leave.reason')
                            ->label('Alasan Cuti'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                            })
                            ->label('Status'),

                        TextEntry::make('created_at')
                            ->label('Tanggal Pengajuan')
                            ->dateTime(),
                    ])
                    ->columns(2),

                Section::make('Data Pegawai')
                    ->description('Data Pegawai yang Mengajukan Cuti')
                    ->schema([
                        TextEntry::make('leave.user.name')
                            ->label('Nama Pegawai'),

                        TextEntry::make('leave.user.email')
                            ->label('Email Pegawai'),

                        TextEntry::make('leave.user.phone')
                            ->label('No. Telepon'),
                    ])
                    ->columns(2),

                Section::make('Data Approver')
                    ->description('Data Approver Pengajuan Cuti')
                    ->schema([
                        TextEntry::make('approver.name')
                            ->label('Nama Approver'),

                        TextEntry::make('approver.email')
                            ->label('Email Approver'),
                    ])
                    ->columns(2),
            ]);
    }
}
