<?php
namespace Packages\LightDDDEcSample\UseCase\Template;

use Packages\LightDDDEcSample\Domain\Model\Template\Entity;
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