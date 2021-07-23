<?php
namespace Packages\DDDEcSample\Infrastructure\Review\Eloquent;

use Packages\DDDEcSample\UseCase\Review\IReviewRepository;
//use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection as Collection;
use Packages\DDDEcSample\Domain\Model\Product\VO\{ProductId, ProductGroupId};
use Packages\DDDEcSample\Domain\Model\Review\Entity\Review;
use Packages\DDDEcSample\Domain\Model\Review\VO\{ReviewId, Initial, Comment, ReviewPoint};
use Packages\DDDEcSample\Domain\Model\Common\VO\InsDate;

/**
 * class ReviewRepository
 * 
 */
class ReviewRepository implements IReviewRepository
{
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findByProductId(ProductId $objProductId) : Collection {
    $_objReview = \DB::table('test_schema.review');
    $_objReview->join("test_schema.review_product", "review_product.review_id", "=", "review.review_id");
    $_objReview->where("review_product.product_id", "=", $objProductId->getValue());
    return $_objReview->cursor()->map(function ($_objRecord) {
      return $this->toModel($_objRecord);
    });
  }
  /**
   * 
   *
   * @return Collection
   * @abstract
   * @access public
   */
  public function findByProductGroupId(ProductGroupId $productGroupId) : Collection {
    $_objReview = \DB::table('test_schema.review');
    $_objReview->join("test_schema.review_product", "review_product.review_id", "=", "review.review_id");
    $_objReview->join("test_schema.product", "product.product_id", "=", "review_product.product_id");
    $_objReview->where("product.product_group_id", "=", $productGroupId->getValue());
    return $_objReview->cursor()->map(function ($_objRecord) {
      return $this->toModel($_objRecord);
    });
  }
  private function toModel($_objRecord) : Review {
    return new Review(
        new ReviewId($_objRecord->review_id)
      , new Initial($_objRecord->initial)
      , new ReviewPoint($_objRecord->review_point)
      , new Comment($_objRecord->comment)
      , new InsDate($_objRecord->ins_date)
    );
  }
}