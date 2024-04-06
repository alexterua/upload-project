<?php

namespace App\Imports;

use App\Factories\IncorrectRowFactory;
use App\Factories\RowFactory;
use App\Models\IncorrectRow;
use App\Models\Row;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataImport implements ToCollection
{
    private int $fileId;

    public function __construct($fileId)
    {
        $this->fileId = $fileId;
    }

    /** @param Collection $collection */
    public function collection(Collection $collection): void
    {
        $collection->chunk(500)->each(function ($rows) {
            foreach ($rows as $row) {
                $allMatch = $row->every(function ($item) {
                    return is_string($item) && ctype_alpha(str_replace(' ', '', $item));
                });

                if ($allMatch) {
                    $rowFactory = RowFactory::make($row, $this->fileId);
                    Row::create([
                        'data' => $rowFactory->getData(),
                        'file_id' => $rowFactory->getFileId()
                    ]);
                } else {
                    $incorrectRowFactory = IncorrectRowFactory::make($row, $this->fileId);
                    IncorrectRow::create([
                        'data' => $incorrectRowFactory->getData(),
                        'file_id' => $incorrectRowFactory->getFileId()
                    ]);
                }
            }
        });

    }

}
