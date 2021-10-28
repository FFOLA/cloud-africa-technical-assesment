<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreInvoiceRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_address' => 'required',
            'invoice_id' => 'nullable',
            'invoice_detail' => 'required|array',
            'invoice_detail.*.product_name' => 'required|string',
            'invoice_detail.*.quantity' => 'required|integer|min:1',
            'invoice_detail.*.unit_price' => 'required|integer|min:1',
            // 'invoice_detail.*.total_price' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = '';
        foreach ($validator->errors()->all() as $error) {
            $message .= "$error <br/> ";
        }
        $response = response()->json([
            'status' => 'error',
            'message' => $message,
        ], 400);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
