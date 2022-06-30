<?php

namespace Application\Requests;

use Simple\FormRequest;

class SortRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => [
                'required', 'lengthMin:2'
            ],
            'strategy' => [
                'required', 'in:Quick,Merge'
            ]
        ];
    }
}