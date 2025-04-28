<?php

namespace App\Filament\Resources\LeaveApprovalResource\Pages;

use App\Filament\Resources\LeaveApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaveApproval extends EditRecord
{
    protected static string $resource = LeaveApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
