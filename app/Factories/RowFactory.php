<?php

namespace App\Factories;

class RowFactory
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
     * @return RowFactory
     */
    public static function make(string $data, int $fileId): RowFactory
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
