<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateMeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus di isi.',
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
            'meeting_date' => 'required|date_format:"Y-m-d"',
            'duration' => 'numeric|max:999',
            'notes' => 'string',
            'duration' => 'numeric|max:999',
            'topic' => 'max:255',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
            
    //     });
    // }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'notulen_id' => 'notulen',
            'room_id' => 'ruangan',
            'meeting_date' => 'tanggal rapat',
            'topic' => 'topik',
            'notes' => 'catatan rapat'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {   
        // $this->merge([
        //     'meeting_date' => $this->meeting_date.' '.$this->jam,
        // ]);
    }
}