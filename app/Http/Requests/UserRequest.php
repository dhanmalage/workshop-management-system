<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
                    'name' => 'required|min:3|max:32',
                    'role' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:3|confirmed',
                    'password_confirmation' => 'required|min:3'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|min:3|max:32',
                    'role' => 'required',
                    'email' => 'required|email'
                ];
            }
            default:break;
        }
    }
}
