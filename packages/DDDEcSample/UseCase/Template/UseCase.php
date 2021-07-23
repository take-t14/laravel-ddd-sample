<?php
namespace Packages\DDDEcSample\UseCase\Template;

use Packages\DDDEcSample\Domain\Model\Template\Entity;
use Illuminate\View\View;


/**
 * class UseCase
 * 
 */
class UseCase implements IUseCase
{
  /**
   * 
   *
   * @param InputData inputData 

   * @return View
   * @abstract
   * @access public
   */
  public function handle(InputData $inputData) : View {
  }
}