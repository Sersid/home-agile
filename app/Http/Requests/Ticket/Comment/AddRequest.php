<?php

namespace App\Http\Requests\Ticket\Comment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddRequest
 * @package App\Http\Requests\Ticket\Comment
 */
class AddRequest extends FormRequest
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
            'text' => 'required|string',
        ];
    }
}
