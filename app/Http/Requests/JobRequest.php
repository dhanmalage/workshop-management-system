<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class JobRequest extends Request
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'advisor' => 'required',
                    'estimate_id' => 'unique:jobs',
                    'section-incharge' => 'required',
                    'promised_date' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'advisor' => 'required',
                    'estimate_id' => 'unique:jobs',
                    'section-incharge' => 'required',
                    'promised_date' => 'required',
                ];
            }
            default:break;
        }
    }
}
