<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'files';

    public static function saveToDB($dataFile)
    {
        // Here you can add a private static method to generate unique file names by adding a timestamp tag.
        // Then save, for example, on s3

        $file = File::create([
            'name' => $dataFile->getClientOriginalName(),
            'mime_type' => $dataFile->getClientOriginalExtension(),
            // TODO Add relationships
            'user_id' => 1
        ]);

        return $file;
    }
}
