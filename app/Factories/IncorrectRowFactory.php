<?php

namespace App\Factories;

class IncorrectRowFactory
{
    private string $data;
    private int $file_id;

    /**
     * @param string $data
     * @param int $file_id
     */
    public function __construct(string $data, int $file_id)
    {
        $this->data = $data;
        $this->file_id = $file_id;
    }

    /**
     * @param string $data
     * @param int $fileId
     * @return IncorrectRowFactory
     */
    public static function make(string $data, int $fileId): IncorrectRowFactory
    {
        return new self(
            $data,
            $fileId
        );
    }

    /** @return string */
    public function getData(): string
    {
        return $this->data;
    }

    /** @return int */
    public function getFileId(): int
    {
        return $this->file_id;
    }
}
