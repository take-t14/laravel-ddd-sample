<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $review_id
 * @property int $product_id
 */
class ReviewProduct extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.review_product';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

}
