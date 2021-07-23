<?php

namespace Packages\MvcSample\App\Libs;

class CustomValidator extends \Illuminate\Validation\Validator
{
  /**
   * ふりがなのバリデーション
   *
   * @param $attribute
   * @param $value
   * @param $parameters
   * @return bool
   */
  public function validateKana($attribute, $value, $parameters)
  {
    if (mb_strlen($value) > 100) {
      return false;
    }  
    if (preg_match('/[^ぁ-んー]/u', $value) !== 0) {
      return false;
    }
    return true;
  }
  /**
   * メールドメインのバリデーション
   *
   * @param $attribute
   * @param $value
   * @param $parameters
   * @return bool
   */
  public function validateMaildomain($attribute, $value, $parameters)
  {
    $to = $value;
    $domain = explode('@', $to);
    $domain = end($domain);
    getmxrr($domain, $mx);
    if (0 >= count($mx)) {
      return false;
    }
    return true;
  }
  /**
   * 電話番号のパターンのバリデーション
   *
   * @param $attribute
   * @param $value
   * @param $parameters
   * @return bool
   */
  public function validateTelPtn($attribute, $value, $parameters)
  {
    if (!preg_match("/^[0-9]{1}[0-9¥-]*[0-9]{1}$/", $value)) {
      return false;
    }
    return true;
  }
  /**
   * 電話番号の長さのバリデーション
   *
   * @param $attribute
   * @param $value
   * @param $parameters
   * @return bool
   */
  public function validateTelLen($attribute, $value, $parameters)
  {
    if (11 < strlen(str_replace("-", "", $value))) {
      return false;
    }
    return true;
  } 
  /**
   * 郵便番号番号のバリデーション
   *
   * @param $attribute
   * @param $value
   * @param $parameters
   * @return bool
   */
  public function validateZip($attribute, $value, $parameters)
  {
    if (!preg_match("/^[0-9]{3}[¥-]?[0-9]{4}$/", $value)) {
      return false;
    }
    return true;
  }
}
