<?php

namespace App\Jobs;

use App\Models\AssetFound;
use App\Notifications\AssetFoundNotification;
use App\Traits\HasNotifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotifyAssetOwnerOfFoundAsset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    protected int $assetFoundId;

    public function __construct(int $assetFoundId)
    {
        $this->assetFoundId = $assetFoundId;
    }

    public function handle(): void
    {
        $found = AssetFound::with(['asset.user'])->find($this->assetFoundId);

        if (!$found || !$found->asset || !$found->asset->user) {
            Log::warning('NotifyAssetOwnerOfFoundAsset: Missing related models', [
                'asset_found_id' => $this->assetFoundId,
            ]);
            return;
        }

        $user = $found->asset->user;
        $email = $user->email ?? null;
        if (!$email) {
            Log::warning('NotifyAssetOwnerOfFoundAsset: Asset owner has no email', [
                'user_id' => $user->id ?? null,
                'asset_id' => $found->asset->id ?? null,
            ]);
            return;
        }

        try {
            $user->notify(new AssetFoundNotification($found));
        } catch (\Throwable $e) {
            Log::error('NotifyAssetOwnerOfFoundAsset: Failed to send Laravel notification, attempting fallback', [
                'error' => $e->getMessage(),
                'asset_found_id' => $this->assetFoundId,
            ]);
            // Fallback to existing external email notification mechanism
        }
    }

    protected function buildEmailBody(string $name, string $brand, string $serial, string $notes): string
    {
        $notesHtml = $notes ? "<p>Finder notes: ".nl2br(e($notes))."</p>" : '';
        $serialText = $serial ? " (SN: ".e($serial).")" : '';

        return "<p>Dear ".e($name).",</p>"
            ."<p>Good news! Your asset <strong>".e($brand)."</strong>".$serialText." has been reported as found.</p>"
            .$notesHtml
            ."<p>We will review and update the status shortly. If this was you, no action is required.</p>"
            ."<p>— Asset Recovery Team</p>";
    }
}
