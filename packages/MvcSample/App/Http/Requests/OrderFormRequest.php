<?php

namespace Packages\MvcSample\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
              "last_name"   => ["required", "max:20"]
            , "first_name" => ["required", "max:20"]
            , "mail" => ["required", "email", "maildomain"]
            , "tel" => ["required", "telptn", "tellen"]
            , "zip" => ["required", "zip"]
            , "address1" => ["required"]
        ];
    }
    public function messages(){
        return [
              "last_name.required"  => "氏名を入力してください。"
            , "last_name.max"       => "氏名は20字以内でお願いします。"
            , "first_name.required"  => "名前を入力してください。"
            , "first_name.max"       => "名前は20字以内でお願いします。"
            , "mail.required"  => "メールアドレスを入力してください。"
            , "mail.email"       => "メールアドレスの入力に誤りがあります。"
            , "mail.maildomain"       => "メールアドレスの入力に誤りがあります。"
            , "tel.required"       => "電話番号を入力してください。"
            , "tel.telptn"       => "電話番号の入力に誤りがあります。"
            , "tel.tellen"       => "電話番号は数字11桁以内で入力して下さい。"
            , "zip.required"       => "郵便番号を入力してください。"
            , "zip.zip"       => "郵便番号の記入に誤りがあります。"
            , "address1.required"       => "住所を入力してください。"
        ];
    }
}
