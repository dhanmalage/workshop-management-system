<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EstimateRequest extends Request
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
                    /*'department' => 'required',
                    'mileage_in' => 'required',
                    'estimate_type' => 'required',
                    'insurance_company' => 'required',
                    'vehicle_id' => 'required_without_all:reg_no,make,model',
                    'reg_no' => 'required_without_all:vehicle_id,make,model',
                    'make' => 'required_without_all:vehicle_id,reg_no,model',
                    'model' => 'required_without_all:vehicle_id,reg_no,make',*/
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    /*'customer_id' => 'required',
                    'department' => 'required',
                    'mileage_in' => 'required',
                    'estimate_type' => 'required',
                    'insurance_company' => 'required',*/
                ];
            }
            default:break;
        }
    }
}
