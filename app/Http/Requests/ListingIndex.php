<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingIndex extends FormRequest
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
            'orderBy' => 'in:price,created_at,listed_on',
            'saved' => 'in:true,false',
        ];
    }
}
