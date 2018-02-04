<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'teaser' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'nullable|mimes:pdf,jpeg,bmp,png'
        ];
    }

    /**
     * Return the fields and values to create a new post from
     */
    public function postFillData()
    {
        $published_at = new Carbon(
            $this->publish_date.' '.$this->publish_time
        );
        
        return [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'teaser' => $this->teaser,
            'content' => $this->get('content'),
            'image' => $this->image,
            'published_at' => $published_at
        ];
    }
}
