<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'fileName' => $this->getName(),
            'countOfRows' => $this->rows()->count(),
            'countOfIncorrectRows' => $this->incorrect_rows()->count(),
            'dateOfUpload' => $this->getFormattedDate()
        ];
    }
}
