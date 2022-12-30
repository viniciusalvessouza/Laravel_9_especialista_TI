<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //eu acho isso um pouco gambairra pois pega o segmento da url pra achar o numero
        $id = $this->segment('2');
        //esses sim faz sentido apesar de estar usando operador ternario hehe
        $id = $this->id ?? '';
        //da pra passar os parametros de validacao como string (como no name) ...
            //... ou como array (como no emaile e em password)
        
        $rules = [
            'name'=>'required|string|max:255|min:3',
            'email'=>[
                'required',
                'email',
                //unique:users -> original
                "unique:users,email,{$id},id"
            ],
            'password'=>[
                'required',
                'min:6',
                'max:15',
            ],
            'image'=>[
                'nullable', //nao obrigatorio
                'image',
                'max:8192',
            ],
            
        ];
        
        if($this->method("PUT"))
            {
                $rules['password'] = [
                    'nullable',
                    'min:6',
                    'max:15',
                ];  
            }
        return $rules;
    }
}
