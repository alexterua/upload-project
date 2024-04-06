<?php

namespace App\Factories;

use Illuminate\Http\UploadedFile;

class FileFactory
{
    private string $name;
    private string $mime_type;
    private int $user_id;

    /**
     * @param string $name
     * @param string $mime_type
     * @param int $user_id
     */
    public function __construct(string $name, string $mime_type, int $user_id)
    {
        $this->name = $name;
        $this->mime_type = $mime_type;
        $this->user_id = $user_id;
    }

    /**
     * @param UploadedFile $dataFile
     * @param int $userId
     * @return FileFactory
     */
    public static function make(UploadedFile $dataFile, int $userId): FileFactory
    {
        return new self(
            $dataFile->getClientOriginalName(),
            $dataFile->getClientOriginalExtension(),
            $userId
        );
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /** @return string */
    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    /** @return int */
    public function getUserId(): int
    {
        return $this->user_id;
    }
}
