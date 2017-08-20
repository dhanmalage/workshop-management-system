<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VehicleRequest extends Request
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
                    'customer_id' => 'required',
                    'reg_no' => 'required|unique:vehicles'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'reg_no' => 'required'
                ];
            }
            default:break;
        }
    }
}
