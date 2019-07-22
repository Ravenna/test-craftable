<?php namespace App\Http\Requests\Admin\Building;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateBuilding extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.building.edit', $this->building);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string'],
            
        ];
    }
}
