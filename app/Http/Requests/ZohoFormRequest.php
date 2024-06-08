<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZohoFormRequest extends FormRequest
{

    public function rules(): array
    {
        return [
          'accountName' => ['required', 'string', 'max:255'],
          'website' => ['required', 'string', 'url', 'max:255'],
          'phone' => ['required', 'string', 'max:255'],
          'dealName' => ['required', 'string', 'max:255'],
          'stage' => ['required', 'string', 'max:255'],
        ];
    }
}
