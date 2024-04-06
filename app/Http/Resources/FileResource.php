<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    private static int $currentNumber = 1;

    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'currentNumber' => self::$currentNumber++,
            'fileName' => $this->getName(),
            'countOfRows' => $this->rows()->count(),
            'countOfIncorrectRows' => $this->incorrect_rows()->count(),
            'dateOfUpload' => $this->getFormattedDate()
        ];
    }
}
