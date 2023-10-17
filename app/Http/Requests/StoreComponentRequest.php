<?php

namespace App\Http\Requests;

use App\Enum\ProtocolTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreComponentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'section_index' => 'string|required',
            'comment' => 'sometimes|string',
            'characteristics' => 'array|required|min:1',
            'characteristics.*.address' => 'string|required',
            'characteristics.*.account_count' => 'numeric|required|min:1',
            'characteristics.*.ip' => 'string|required',
            'protocols' => 'array|required|min:1',
            'protocols.*.type' => [new Enum(ProtocolTypes::class), 'required'],
            'protocols.*.port' => 'numeric|required',
        ];
    }
}
