<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionairReq extends FormRequest
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
        $rules=[];
        switch($this->method())
        {
            case 'POST':
            {
                $rules = [
                    'name'                  => 'required',
                    'duration'    			=> 'required',
                    'resumeable'  			=>  'required|boolean|in:0,1',
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                $rules = [
                    'name'                  => 'required',
                    'duration'    			=> 'required',
                    'resumeable'  			=>  'required|boolean|in:0,1',
                ];
            }
            default:break;
        }
        return $rules;
    }
}
