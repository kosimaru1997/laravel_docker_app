<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Site;

class StoreSiteRequest extends FormRequest
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
            //
            'url' => 'required|unique:sites|',
        ];
    }

    public function withValidator($validator)
    {
        if(!empty($this->url)){

            $validator->after(function ($validator) {

                $site_model = new Site();
                $site_info = $site_model->getSiteInfo($this->url);

                $this->merge([
                    'title' => $site_info['title'],
                    'image' => $site_info['image'],
                    'description' => $site_info['description']
                ]);

                if(is_null($this->title)){
                    $validator->errors()->add('url', 'This URL is Something wrong (can\'t get site-info)');
                }
            });

        }
    }

}
