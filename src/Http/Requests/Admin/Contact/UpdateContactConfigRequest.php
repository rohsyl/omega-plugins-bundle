<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Requests\Admin\Contact;


use Illuminate\Foundation\Http\FormRequest;

class UpdateContactConfigRequest extends FormRequest
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
            'key_site'   => 'nullable|string',
            'key_secret' => 'nullable|string',
        ];
    }
}