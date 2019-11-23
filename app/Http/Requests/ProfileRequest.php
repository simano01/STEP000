<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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

        // ログイン者のユーザーIDを取得
        $user_id = Auth::id();
        return [
          'name' => 'string|max:50',
          'image' => 'file|image|mimes:jpeg,png',
          'introduction' => 'string|max:255',
          'email' => 'required|email',
          'email' => Rule::unique('users')->ignore($user_id),
        ];
    }
}
