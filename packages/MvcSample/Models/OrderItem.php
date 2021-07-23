<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $order_table_id
 * @property int $product_id
 * @property int $quantity
 * @property int $tax_rate
 * @property int $price
 * @property int $price_total
 * @property int $price_taxin
 * @property int $price_total_taxin
 * @method static mixed getOrderItemById(int $orderTableId)
 */
class OrderItem extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.order_item';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = ['order_table_id', 'product_id'];
    // increment無効化
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['order_table_id', 'product_id', 'quantity', 'tax_rate', 'price', 'price_total', 'price_taxin', 'price_total_taxin'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function getOrderItemById(int $orderTableId) {
        return static::where("order_table_id", "=", $orderTableId)->get();
    }
}
