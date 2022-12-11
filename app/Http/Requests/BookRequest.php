<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        if (request()->ip() === 179.118.79.1)
        return true;

//        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'publisher_id' => ['required', 'integer'],
            'publishing_date' => ['required', 'date', 'before_or_equal:today'],
            'latest_printing_date' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:publishing_date'],
            'isbn' => ['required', 'integer', 'digits_between:5,10', Rule::unique('books')->ignore($this->book)],
            'pages' => ['nullable', 'integer', 'max:9999'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
