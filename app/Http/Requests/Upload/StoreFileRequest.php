<?php

namespace App\Http\Requests\Upload;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreFileRequest extends FormRequest
{
    /** @return bool */
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, ValidationRule|array|string> */
    public function rules(): array
    {
        if ($this->file->getClientOriginalExtension() !== 'csv') {
            throw ValidationException::withMessages(['The file must be in csv format']);
        }
        return [
            'file' => 'required|file'
        ];
    }

}
