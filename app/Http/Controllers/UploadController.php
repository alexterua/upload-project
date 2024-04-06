<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\StoreFileRequest;
use App\Jobs\ProcessCsvUploadJob;
use App\Models\File;

class UploadController extends Controller
{
    public function index()
    {
        return inertia('Upload/Index');
    }

    public function store(StoreFileRequest $request)
    {
        $data = $request->validated();
        $dataFile = $data['file'];

        $path = File::saveToStorage($dataFile);
        $file = File::saveToDB($dataFile);

        ProcessCsvUploadJob::dispatch($path, $file->getId());
    }

}
