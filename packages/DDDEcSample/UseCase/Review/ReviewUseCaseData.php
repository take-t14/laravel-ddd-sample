<?php
namespace Packages\DDDEcSample\UseCase\Review;

use Packages\DDDEcSample\Domain\Model\Review\Entity\Review;
use Packages\DDDEcSample\UseCase\Common\{IntegerUseCaseData, StringUseCaseData};

/**
 * class ReviewUseCaseData
 * 
 */
class ReviewUseCaseData
{
  private $reviewId = null;
  private $initial = null;
  private $reviewPoint = null;
  private $comment = null;
  private $insDate = null;
  function __construct(?Review $review) {
    if (!isset($review)) {
      return;
    }
    $this->reviewId = new IntegerUseCaseData($review->getReviewId()->getValue());
    $this->initial = new StringUseCaseData($review->getInitial()->getValue());
    $this->reviewPoint = new IntegerUseCaseData($review->getReviewPoint()->getValue());
    $this->comment = new StringUseCaseData($review->getComment()->getValue());
    $this->insDate = new StringUseCaseData($review->getInsDate()->getValue());
  }
  function getReviewId() : IntegerUseCaseData {
    return $this->reviewId;
  }
  function getInitial() : StringUseCaseData {
    return $this->initial;
  }
  function getReviewPoint() : IntegerUseCaseData {
    return $this->reviewPoint;
  }
  function getComment() : StringUseCaseData {
    return $this->comment;
  }
  function getInsDate() : StringUseCaseData {
    return $this->insDate;
  }
}