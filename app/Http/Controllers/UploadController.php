<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\StoreFileRequest;
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
        File::saveToDB($data['file']);
    }

}
