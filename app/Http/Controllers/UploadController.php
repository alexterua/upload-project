<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\StoreFileRequest;
use App\Http\Resources\FileResource;
use App\Jobs\ProcessCsvUploadJob;
use App\Models\File;

class UploadController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $files = $user->files()->orderByDesc('created_at')->paginate(10);

        $files = FileResource::collection($files);

        return inertia('Upload/Index', compact('files'));
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
