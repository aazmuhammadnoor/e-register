<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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

        dd($this->input);
        $syarat = count($this->input('syarat'));
        foreach(range(0, $syarat) as $index) {
            $rules['syarat.' . $index] = 'mimetypes:application/pdf,application/vnd.cups-pdf,application/vnd.sealedmedia.softseal.pdf,image/jpeg,image/png|max:5000';
        }

        return $rules;
    }
}
