<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'files';

    /** @return BelongsTo */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /** @return HasMany */
    public function rows(): HasMany
    {
        return $this->hasMany(Row::class, 'file_id', 'id');
    }

    /** @return HasMany */
    public function incorrect_rows(): HasMany
    {
        return $this->hasMany(IncorrectRow::class, 'file_id', 'id');
    }

    public static function saveToDB($dataFile)
    {
        // Here you can add a private static method to generate unique file names by adding a timestamp tag.
        // Then save, for example, on s3
        $user = auth()->user();

        $file = File::create([
            'name' => $dataFile->getClientOriginalName(),
            'mime_type' => $dataFile->getClientOriginalExtension(),
            'user_id' => $user->getId()
        ]);

        return $file;
    }
}
