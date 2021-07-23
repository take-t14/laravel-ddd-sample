<?php
namespace Packages\DDDEcSample\InterfaceAdapters\Presenters\Review;

use Packages\DDDEcSample\UseCase\Review\ReviewUseCaseData;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;
use Packages\DDDEcSample\InterfaceAdapters\Presenters\Common\{IntegerViewData, StringViewData};

/**
 * class ReviewViewData
 * 
 */
class ReviewViewData implements Arrayable
{
  use ViewModelTrait;
  private $reviewId = null;
  private $initial = null;
  private $reviewPoint = null;
  private $comment = null;
  private $insDate = null;
  function __construct(ReviewUseCaseData $review) {
    if (!isset($review)) {
      return;
    }
    $this->reviewId = new IntegerViewData($review->getReviewId()->getValue());
    $this->initial = new StringViewData($review->getInitial()->getValue());
    $this->reviewPoint = new IntegerViewData($review->getReviewPoint()->getValue());
    $this->comment = new StringViewData($review->getComment()->getValue());
    $this->insDate = new StringViewData($review->getInsDate()->getValue());
  }
  function getReviewId() : IntegerViewData {
    return $this->reviewId;
  }
  function getInitial() : StringViewData {
    return $this->initial;
  }
  function getReviewPoint() : IntegerViewData {
    return $this->reviewPoint;
  }
  function getComment() : StringViewData {
    return $this->comment;
  }
  function getInsDate() : StringViewData {
    return $this->insDate;
  }
}