<?php namespace App\Http\Requests;

class AssignRolesRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Entrust::hasRole('Administrator');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id'
        ];
    }

}