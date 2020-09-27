<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     *
     * @todo check 'opened_since' is a valid date
     */
    public function rules()
    {
        $regex = '/^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[012])-(18|19|20)\d\d$/';

        return [
            'name' => 'required|string|max:128',
            'opened_since' => ['required', 'regex:' . $regex,]
        ];
    }
}
