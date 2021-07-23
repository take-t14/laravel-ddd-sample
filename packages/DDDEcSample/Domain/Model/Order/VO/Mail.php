<?php
namespace Packages\DDDEcSample\Domain\Model\Order\VO;

use Packages\DDDEcSample\Domain\Model\Common\Exception\RuntimeException\VO\ValidateException;
use Packages\DDDEcSample\Domain\Model\Common\VO\StringValue;

/**
 * class Mail
 * 
 */
class Mail extends StringValue
{
  function __construct(string $mail) {
    $validateException = new ValidateException("mail");
    if ("" === $mail) {
      $validateException = $validateException->addError("メールアドレスを入力して下さい");
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $validateException = $validateException->addError("メールアドレスの記入に誤りがあります");
    }
    if (!$this->isExistDomain($mail)) {
      $validateException = $validateException->addError("メールアドレスの記入に誤りがあります");
    }
    $validateException->throwIfErrorExist();
    parent::__construct($mail);
  }
  function isExistDomain(string $mail) : bool {
    $to = $mail;
    $domain = explode('@', $to);
    $domain = end($domain);
    getmxrr($domain, $mx);
    if (0 >= count($mx)) {
      return false;
    }
    return true;
  }
}