<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|string|max:255',
            'address'           => 'string',
            'price'             => 'nullable|numeric',
            'property_type_id'  => 'required|exists:property_types,id',
            'unit_type_id'      => 'required|exists:unit_types,id',
            'status_id'         => 'nullable|exists:statuses,id',
            'tenant_id'         => 'nullable|exists:tenants,id',
        ];
    }
}
