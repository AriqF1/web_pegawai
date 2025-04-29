<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Statistics extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = \App\Models\User::count();
        $leaveApprovalCount = \App\Models\LeaveApproval::count();
        return [
            Stat::make('Jumlah Pegawai', number_format($userCount))
                ->description('Jumlah pegawai di sistem')
                ->icon('heroicon-o-users'),
            Stat::make('Jumlah Approval Cuti', number_format($leaveApprovalCount))
                ->description('Jumlah pengajuan cuti yang telah diajukan')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
