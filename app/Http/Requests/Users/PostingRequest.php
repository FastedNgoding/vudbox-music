<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class PostingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $audioRule = $this->isMethod('PUT') || $this->isMethod('PATCH')
            ? 'nullable|file|mimes:mp3,wav,ogg,m4a,flac|max:20480'
            : 'required|file|mimes:mp3,wav,ogg,m4a,flac|max:20480';

        $coverRule = $this->isMethod('PUT') || $this->isMethod('PATCH')
            ? 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096'
            : 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096';

        return [
            'title'    => 'required|string|max:200',
            'artist'   => 'required|string|max:200',
            'album'    => 'nullable|string|max:200',
            'genre_id' => 'nullable|exists:genres,id',
            'cover'    => $coverRule,
            'audio'    => $audioRule,
        ];
    }
}
