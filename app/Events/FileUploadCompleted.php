<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileUploadCompleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $fileId;

    /** @param int $fileId */
    public function __construct(int $fileId)
    {
        $this->fileId = $fileId;
    }

    /** @return array<int, Channel> */
    public function broadcastOn(): array
    {
        return [
            new Channel('files'),
        ];
    }

    /** @return array<string, mixed> */
    public function broadcastWith(): array
    {
        return [
            'fileId' => $this->fileId
        ];
    }
}
