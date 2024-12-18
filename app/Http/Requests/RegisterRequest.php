<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:5',
            'email'=>'email|required|unique:users,email',
            'password'=>'required'
        ];
    }
    public function messages()
    {
        return
            ['name.required' => 'name is required'];
    }
    // public function failedValidation(Validator $validator)

    // {

    //     throw new HttpResponseException(response()->json([

    //         'success'   => false,

    //         'message'   => 'Validation errors',

    //         'data'      => $validator->errors()

    //     ]));

    // }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], 422)); // Set status code to 422
    }
    
}
