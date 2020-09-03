<?php

namespace App\Http\Requests;

use App\Account;
use App\Http\Serialization\Denormalizer\TransactionStoreDenormalizer;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
            'to' => ['required', 'exists:accounts,id', 'not_in:' . $this->input('from')],
            'amount' => ['required', 'numeric', 'min:0.1'],
            'details' => ['required', 'max:250']
        ];
    }

    public function denormalize(): TransactionStoreDenormalizer
    {
        return new TransactionStoreDenormalizer($this);
    }
}
