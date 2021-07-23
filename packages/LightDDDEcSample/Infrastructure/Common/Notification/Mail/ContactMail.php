<?php
namespace Packages\LightDDDEcSample\Infrastructure\Common\Notification\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

  private $froms = [];
  private $subjectVal = "";
  private $viewName = "";
  public $datas = [];

    public function __construct(array $froms, string $subject, string $view, array $datas)
    {
      $this->froms = $froms;
      $this->subjectVal = $subject;
      $this->viewName = $view;
      $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->from($this->froms)
          ->subject($this->subjectVal)
          ->text($this->viewName);
    }
}
