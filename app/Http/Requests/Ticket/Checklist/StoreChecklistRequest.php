<?php

namespace App\Http\Requests\Ticket\Checklist;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreChecklistRequest
 * @package App\Http\Requests\Ticket\Checklist
 */
class StoreChecklistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ticket_id' => 'required|integer|exists:tickets,id',
            'title' => 'required|string',
        ];
    }
}
