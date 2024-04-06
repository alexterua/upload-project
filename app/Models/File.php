<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use HasFactory;

    const STORAGE_OPTION = 'public';

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

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param UploadedFile $dataFile
     * @return string
     */
    public static function saveToStorage(UploadedFile $dataFile): string
    {
        $filenameWithoutExtension = pathinfo($dataFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $filenameWithoutExtension . '_' . time() . '.' . $dataFile->getClientOriginalExtension();
        $file = $dataFile->storeAs('files', $fileName, File::STORAGE_OPTION);

        return $file;
    }

    /**
     * @param UploadedFile $dataFile
     * @return self
     */
    public static function saveToDB(UploadedFile $dataFile): self
    {
        $user = auth()->user();

        return File::create([
            'name' => $dataFile->getClientOriginalName(),
            'mime_type' => $dataFile->getClientOriginalExtension(),
            'user_id' => $user->getId()
        ]);
    }

}
