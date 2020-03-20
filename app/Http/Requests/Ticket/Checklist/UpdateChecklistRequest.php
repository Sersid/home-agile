<?php

namespace App\Http\Requests\Ticket\Checklist;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateChecklistRequest
 * @package App\Http\Requests\Ticket\Checklist
 */
class UpdateChecklistRequest extends FormRequest
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
            'title' => 'required|string',
            'status' => 'required|boolean',
        ];
    }
}
