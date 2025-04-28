<?php

namespace App\Filament\Resources\LeaveApprovalResource\Pages;

use App\Filament\Resources\LeaveApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaveApproval extends ViewRecord
{
    protected static string $resource = LeaveApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
