<?php

namespace App\Http\Requests;

use App\Models\Document;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->documentAction) {
            case 'updateDocInfo':
                $rules = [
                    'title' => [
                        'required',
                        Rule::unique('documents')->ignore($this->document->id)
                    ],
                    'program' => 'required|min:2',
                    'date_submitted' => 'required',
                    'upload_file' => 'nullable|file|mimetypes:application/pdf',
                    'excerpt' => 'required',
                ];
                break;
            
            case 'addAuthor':
                $rules = [
                    'authors.*.first_name' => 'required',
                    'authors.*.last_name' => 'required',
                ];
                break;

            case 'removeAuthor':
                $rules = [];
                break;
            
            default:
                $rules = [
                    'title' => 'required|unique:documents',
                    'program' => 'required|min:2',
                    'date_submitted' => 'required',
                    'upload_file' => 'required|file|mimetypes:application/pdf',
                    'excerpt' => 'required',
                    'authors.*.first_name' => 'required',
                    'authors.*.last_name' => 'required',
                ];
                break;
        }

        return $rules;
    }

    public function messages() {
        $messages = [];

        if($this->documentAction == 'createDocument' || $this->documentAction == 'addAuthor') {
            foreach ($this->get('authors') as $key => $val) {
                $messages["authors.$key.first_name.required"] = "The author " . ($key + 1) . " first name field is required.";
                $messages["authors.$key.last_name.required"] = "The author " . ($key + 1) . " last name field is required.";
            }
        }
        
        return $messages;
    }
}
