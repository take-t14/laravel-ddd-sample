<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $review_id
 * @property string $initial
 * @property int $review_point
 * @property string $comment
 * @property string $ins_date
 * @method static array getReviewsByProductGroupId(int $productGroupId)
 * @method static array reviewDbToArray($records)
 */
class Review extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.review';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'review_id';

    /**
     * @var array
     */
    protected $fillable = ['initial', 'review_point', 'comment', 'ins_date'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function getReviewsByProductGroupId(int $productGroupId) : array {
        $reviewQuery = \DB::table('test_schema.review');
        $reviewQuery = $reviewQuery->join("test_schema.review_product", "review_product.review_id", "=", "review.review_id");
        $reviewQuery = $reviewQuery->join("test_schema.product", "product.product_id", "=", "review_product.product_id");
        $reviewQuery = $reviewQuery->where("product.product_group_id", "=", $productGroupId);
        $records = $reviewQuery->cursor();
        return static::reviewDbToArray($records);
    }
    protected function reviewDbToArray($records) : array {
        $reviews = [];
        foreach($records as $record) {
            $review = [];
            $review["reviewId"]["value"] = $record->review_id;
            $review["initial"]["value"] = $record->initial;
            $review["reviewPoint"]["value"] = $record->review_point;
            $review["comment"]["value"] = $record->comment;
            $review["insDate"]["value"] = $record->ins_date;
            $reviews[] = $review;
        }
        return $reviews;
    }
}
