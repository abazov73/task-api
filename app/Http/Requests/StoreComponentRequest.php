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
            'name.required' => 'Название компонента не может быть пустым',
            'section_index.required' => 'Индекс раздела компонента не может быть пустым',
            'characteristics.required' => 'Добавьте хотя бы одну характеристику',
            'characteristics.*.address.required' => 'Адрес подключения характеристики не может быть пустым',
            'characteristics.*.account_count.min' => 'Количество учетных записей характерисики должно быть больше 0',
            'characteristics.*.ip.required' => 'IP характеристики не может быть пустым',
            'characteristics.*.protocols.required' => 'Добавьте хотя бы один протокол',
            'characteristics.*.protocols.*.type.enum' => 'Такого протокола не существует',
            'characteristics.*.protocols.*.port.required' => 'Порт протокола не можект быть пустым'
        ];
    }
}
