<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $cart_id
 * @property int $product_id
 * @property int $quantity
 * @property int $price_total
 * @property int $price_taxin
 * @property int $price_total_taxin
 * @method static array makeCartItemByCartId(int $cartId)
 * @method static array cartItemDbToArray($record)
 */
class CartItem extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.cart_item';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = ['cart_id', 'product_id'];
    // increment無効化
    public $incrementing = false;
    /**
     * @var array
     */
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price_total', 'price_taxin', 'price_total_taxin'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function makeCartItemByCartId(int $cartId) : array {
        $retCartItems = [];
        $cartItems = static::where("cart_id", "=", $cartId)
            ->join("test_schema.product", "cart_item.product_id", "=", "product.product_id")
            ->join("test_schema.color", "product.color_id", "=", "color.color_id")
            ->join("test_schema.size", "product.size_id", "=", "size.size_id")
            ->orderBy("product.product_id")
            ->orderBy("product.product_name")
            ->cursor();
        foreach($cartItems as $cartItem) {
            $retCartItems[]= static::cartItemDbToArray($cartItem);
        }
        return $retCartItems;
    }
    protected function cartItemDbToArray($record) : array {
        return [
            "cartId" => ["value" => $record->cart_id]
            , "quantity" => ["value" => $record->quantity]
            , "taxRate" => ["value" => $record->tax_rate]
            , "price" => ["value" => $record->price]
            , "priceTotal" => ["value" => $record->price_total]
            , "priceTaxIn" => ["value" => $record->price_taxin]
            , "priceTotalTaxin" => ["value" => $record->price_total_taxin]
            , "product" => \Packages\MvcSample\Models\Product::productDbToArray($record)
        ];
    }
}
