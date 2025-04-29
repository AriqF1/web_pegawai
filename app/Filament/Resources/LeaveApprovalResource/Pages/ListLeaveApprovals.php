<?php

namespace App\Filament\Resources\LeaveApprovalResource\Pages;

use App\Filament\Resources\LeaveApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaveApprovals extends ListRecords
{
    protected static string $resource = LeaveApprovalResource::class;
    protected static ?string $title = 'Persetujuan Cuti';

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
