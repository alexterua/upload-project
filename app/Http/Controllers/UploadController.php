<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\StoreFileRequest;
use App\Http\Resources\FileResource;
use App\Jobs\ProcessCsvUploadJob;
use App\Models\File;
use Inertia\Response;
use Inertia\ResponseFactory;

class UploadController extends Controller
{
    /** @return Response|ResponseFactory */
    public function index(): Response|ResponseFactory
    {
        $user = auth()->user();
        $files = $user->files()->orderByDesc('created_at')->paginate(10);

        $files = FileResource::collection($files);

        return inertia('Upload/Index', compact('files'));
    }

    /** @param  StoreFileRequest $request */
    public function store(StoreFileRequest $request): void
    {
        $data = $request->validated();
        $dataFile = $data['file'];

        $path = File::saveToStorage($dataFile);
        $file = File::saveToDB($dataFile);

        ProcessCsvUploadJob::dispatch($path, $file->getId());
    }

}
