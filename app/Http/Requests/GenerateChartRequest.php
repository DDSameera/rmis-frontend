<?php

namespace App\Http\Requests;

use App\Rules\ValidateCSVFile;
use App\Traits\SendResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class GenerateChartRequest extends FormRequest
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
            'excel_file' => ['required', new ValidateCSVFile()]
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->redirectTo('dashboard')->with('error',$validator->errors()->all()));
    }


}
