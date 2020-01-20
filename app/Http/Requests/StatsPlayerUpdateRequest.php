<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatsPlayerUpdateRequest extends FormRequest
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
            //
            'current_rating' => 'required|numeric|min:75|max:97',
            'goals' => 'required|numeric',
            'position' => 'required',
            'pace' => 'required|numeric|min:75|max:97',
            'shoot' => 'required|numeric|min:75|max:97',
            'passe' => 'required|numeric|min:75|max:97',
            'dribble' => 'required|numeric|min:75|max:97',
            'defense' => 'required|numeric|min:75|max:97',
            'physique' => 'required|numeric|min:75|max:97',
            'strong_foot' => 'required',
            'skill' => 'required',
        ];
    }
}
