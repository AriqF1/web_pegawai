<?php

namespace App\Filament\Resources\LeaveTypeResource\Pages;

use App\Filament\Resources\LeaveTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLeaveType extends CreateRecord
{
    protected static string $resource = LeaveTypeResource::class;
    protected static ?string $title = 'Tambah Tipe Cuti';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
