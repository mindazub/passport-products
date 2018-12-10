<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProductGenerateRequest
 * @package App\Http\Requests
 */
class ProductGenerateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'count' => 'required|numeric|min:1|max:10000',
        ];
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return (int)$this->input('count');
    }
}
