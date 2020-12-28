<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'    => [
                'required'],
            'email'   => [
                'required', 'string', 'email', 'max:255', 'unique:users,email,' . request()->route('user')->id],
            'password' => ['confirmed'],
            'mobile_no' => ['required', 'numeric', 'min:11'],
            'status' => ['required', 'in:0,1'],
            'roles'   => ['required','array'],
        ];

    }
}
