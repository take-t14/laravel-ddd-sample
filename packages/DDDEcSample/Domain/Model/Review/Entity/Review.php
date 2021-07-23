<?php
namespace Packages\DDDEcSample\Domain\Model\Review\Entity;

use Packages\DDDEcSample\Domain\Model\Review\VO\{ReviewId, Initial, ReviewPoint, Comment};
use Packages\DDDEcSample\Domain\Model\Common\VO\InsDate;

/**
 * class Review
 * 
 */
class Review
{
  /** @var ReviewId */
  private $reviewId = null;
  /** @var Initial */
  private $initial = null;
  /** @var ReviewPoint */
  private $reviewPoint = null;
  /** @var Comment */
  private $comment = null;
  /** @var InsDate */
  private $insDate = null;
  function __construct(ReviewId $reviewId, Initial $initial, ReviewPoint $reviewPoint
    , Comment $comment, InsDate $insDate) {
    $this->reviewId = $reviewId;
    $this->initial = $initial;
    $this->reviewPoint = $reviewPoint;
    $this->comment = $comment;
    $this->insDate = $insDate;
  }
  function getReviewId() : ReviewId {
    return $this->reviewId;
  }
  function getInitial() : Initial {
    return $this->initial;
  }
  function getReviewPoint() : ReviewPoint {
    return $this->reviewPoint;
  }
  function getComment() : Comment {
    return $this->comment;
  }
  function getInsDate() : InsDate {
    return $this->insDate;
  }
}