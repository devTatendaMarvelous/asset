<?php

namespace App\Notifications;

use App\Models\AssetFound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssetFoundNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly AssetFound $found)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $asset = $this->found->asset;
        $userName = $notifiable->name ?? 'Customer';
        $brand = $asset->brand ?? 'Device';
        $serial = $asset->serial_number ?? '';
        $notes = $this->found->notes ?? '';

        $subject = 'Your asset has been reported found';

        $message = (new MailMessage)
            ->subject($subject)
            ->greeting("Dear {$userName},")
            ->line("Good news! Your asset {$brand}" . ($serial ? " (SN: {$serial})" : '') . " has been reported as found.");

        if (!empty($notes)) {
            $message->line('Finder notes: ' . $notes);
        }

        $message->line('We will review and update the status shortly. If this was you, no action is required.')
            ->salutation('— Asset Recovery Team');

        return $message;
    }
}
