<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
            'max' => ':max :attribute tidak boleh terlalu panjang.',
            'numeric' => ':attribute harus berupa angka.',
            'string' => ':attribute harus berupa huruf.',
            'date_format' => 'Format kolom :attribute adalah Y-m-d.',
            'digits' => 'kodepos harus 5 digit saja.',   
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'name' => 'required',
            'address' => 'required',
            // 'group_id' => 'required',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // if(){
            //     $validator->errors()->add('no_rek_error', 'No. Rek Manual Harus terdapat 6 angka setelah tanda "-" .');
            // }
        });
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'address' => 'alamat',
            'name' => 'nama',
            'group_id' => 'hak akses',
        ];
    }
}