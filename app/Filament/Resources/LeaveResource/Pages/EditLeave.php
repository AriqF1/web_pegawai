<?php

namespace App\Filament\Resources\LeaveResource\Pages;

use App\Filament\Resources\LeaveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditLeave extends EditRecord
{
    protected static string $resource = LeaveResource::class;
    protected static ?string $title = 'Edit Cuti Pegawai';


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function afterSave(): void
    {
        Notification::make()
            ->success()
            ->title('Data cuti telah diperbarui')
            ->send();
    }

    public function getSavedNotification(): ?Notification
    {
        return null; // Nonaktifkan notifikasi bawaan
    }
}
