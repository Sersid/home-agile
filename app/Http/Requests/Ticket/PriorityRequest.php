<?php

namespace App\Http\Requests\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class PriorityRequest
 * @package App\Http\Requests\Ticket
 */
class PriorityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'priority' => [
                'required',
                'integer',
                Rule::in(array_keys(Ticket::getPriorities())),
            ],
        ];
    }
}
