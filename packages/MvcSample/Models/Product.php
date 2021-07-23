<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $product_id
 * @property int $product_group_id
 * @property string $product_name
 * @property int $tax_rate
 * @property int $price
 * @property int $color_id
 * @property int $size_id
 * @method static int calcPriceTaxIn(int $price, int $taxRate)
 * @method static array productDbToArray($record)
 */
class Product extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.product';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * @var array
     */
    protected $fillable = ['product_group_id', 'product_name', 'tax_rate', 'price', 'color_id', 'size_id'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function calcPriceTaxIn(int $price, int $taxRate) : int {
		return $price + floor($price * $taxRate / 100);
	}

    protected function productDbToArray($record) : array {
        $price = $record->price;
        $priceTaxIn = \Packages\MvcSample\Models\Product::calcPriceTaxIn($record->price, $record->tax_rate);
        return [
              "productId" => ["value" => $record->product_id]
            , "productGroupId" => ["value" => $record->product_group_id]
            , "productName" => ["value" => $record->product_name]
            , "price" => ["value" => $price]
            , "priceTaxIn" => ["value" => $priceTaxIn]
            , "taxRate" => ["value" => $record->tax_rate]
            , "color" => [
                "colorId" => ["value" => $record->color_id]
              , "colorName" => ["value" => $record->color_name]
            ]
            , "size" => [
                  "sizeId"  => ["value" => $record->size_id]
                , "sizeName" => ["value" => $record->size_name]
            ]
        ];	
    }

}
