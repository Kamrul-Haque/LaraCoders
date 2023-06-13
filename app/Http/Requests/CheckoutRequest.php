<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1', 'max:5'],
            'items.*.book_id' => ['required', 'integer', 'exists:books,id'],
            'items.*.quantity' => ['required', 'integer', 'max:5'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'digits:11'],
            'customer_address_line_1' => ['required', 'string', 'max:255'],
            'customer_address_line_2' => ['nullable', 'string', 'max:255'],
            'customer_postcode' => ['required', 'string', 'max:255'],
            'customer_city' => ['required', 'string', 'max:255'],
            'customer_country' => ['required', 'string', 'max:255'],
            'voucher_code' => ['nullable', 'string', 'max:10'],
        ];
    }
}
