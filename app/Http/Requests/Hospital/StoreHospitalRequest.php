<?php

namespace App\Http\Requests\Hospital;

use App\Models\Hospital;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreHospitalRequest extends FormRequest
{
    public function authorize()
    {
        //abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            //'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:6', 'confirmed'],
            //'password_confirmation' => ['required', 'string', 'min:6'],
            //'mobile_no' => ['required', 'numeric', 'min:11'],
            //'status' => ['required', 'in:0,1'],
            //'roles'    => [ 'required','array'],
        ];

    }
}
