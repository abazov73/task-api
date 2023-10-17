<?php

namespace App\Http\Requests;

use App\Enum\ProtocolTypes;
use App\Rules\DistinctCharacteristic;
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
            'characteristics' => ['array', 'required', 'min:1', new DistinctCharacteristic()],
            'characteristics.*.address' => 'string|required',
            'characteristics.*.account_count' => 'numeric|required|min:1',
            'characteristics.*.ip' => 'string|required',
            'characteristics.*.protocols' => 'array|required|min:1',
            'characteristics.*.protocols.*.type' => [new Enum(ProtocolTypes::class), 'required'],
            'characteristics.*.protocols.*.port' => 'numeric|required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => config('strings.nameRequired'),
            'section_index.required' => config('strings.sectionIndexRequired'),
            'characteristics.required' => config('strings.characteristicsRequired'),
            'characteristics.*.address.required' => config('strings.characteristicsAddressRequired'),
            'characteristics.*.account_count.numeric' => config('strings.characteristicsAccountCountNumeric'),
            'characteristics.*.account_count.min' => config('strings.characteristicsAccountCountMin'),
            'characteristics.*.ip.required' => config('strings.characteristicsIpRequired'),
            'characteristics.*.protocols.required' => config('strings.characteristicsProtocolsRequired'),
            'characteristics.*.protocols.*.type.Illuminate\Validation\Rules\Enum' => config('strings.characteristicsProtocolsTypeEnum'),
            'characteristics.*.protocols.*.port.required' => config('strings.characteristicsProtocolsPortRequired'),
            'characteristics.*.protocols.*.port.numeric' => config('strings.characteristicsProtocolsPortNumeric'),
        ];
    }
}
