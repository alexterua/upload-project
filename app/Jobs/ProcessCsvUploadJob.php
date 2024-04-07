<?php

namespace App\Jobs;

use App\Imports\DataImport;
use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel;
use Symfony\Component\Console\Command\Command;

class ProcessCsvUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $path;
    private int $fileId;

    /**
     * @param string $path
     * @param int $fileId
     */
    public function __construct(string $path, int $fileId)
    {
        $this->path = $path;
        $this->fileId = $fileId;
    }

    /**
     * @param Excel $excel
     * @return int
     */
    public function handle(Excel $excel): int
    {
        $excel->import(new DataImport($this->fileId), $this->path, File::STORAGE_OPTION);

        return Command::SUCCESS;
    }

}
