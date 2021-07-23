<?php
namespace Packages\MvcSample\Models;

use Packages\MvcSample\App\Http\Controllers\MyObject;

/**
 * @property int $order_table_id
 * @property int $total
 * @property int $total_taxin
 * @property string $last_name
 * @property string $first_name
 * @property string $mail
 * @property string $tel
 * @property string $zip
 * @property string $address1
 * @property string $ins_date
 * @method static mixed saveOrder($cart)
 * @method static array orderDbToViewModel($orderTableRecord)
 */
class OrderTable extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.order_table';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_table_id';

    /**
     * @var array
     */
    protected $fillable = ['total', 'total_taxin', 'last_name', 'first_name', 'mail', 'tel', 'zip', 'address1', 'ins_date'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function saveOrder($cart) {
        return \DB::transaction(function() use($cart) {
            $orderTable = new static;
            $orderTable->fill([
                  "total" => $cart["total"]["value"]
                , "total_taxin" => $cart["totalTaxin"]["value"]
                , "last_name" => \RequestEx::get("last_name")
                , "first_name" => \RequestEx::get("first_name")
                , "mail" => \RequestEx::get("mail")
                , "tel" => \RequestEx::get("tel")
                , "zip" => \RequestEx::get("zip")
                , "address1" => \RequestEx::get("address1")
            ])->save();
            foreach($cart["items"] as $cartItem) {
                \Packages\MvcSample\Models\OrderItem::updateOrInsert([
                      "order_table_id" => $orderTable->order_table_id
                    , "product_id" => $cartItem["product"]["productId"]["value"]
                ], [
                      "quantity" => $cartItem["quantity"]["value"]
                    , "tax_rate" => $cartItem["taxRate"]["value"]
                    , "price" => $cartItem["price"]["value"]
                    , "price_total" => $cartItem["priceTotal"]["value"]
                    , "price_taxin" => $cartItem["priceTaxIn"]["value"]
                    , "price_total_taxin" => $cartItem["priceTotalTaxin"]["value"]
                ]);
            }
            \SessionRepository::forget("mvcCartId");
            return $orderTable;
        });
    }
    protected function orderDbToViewModel($orderTableRecord) : array {
        $order = [
            "lastName" => ["value" => $orderTableRecord->last_name]
            , "firstName" => ["value" => $orderTableRecord->first_name]
            , "orderTableId" => ["value" => $orderTableRecord->order_table_id]
            , "insDate" => ["value" => $orderTableRecord->ins_date]
            , "mail" => ["value" => $orderTableRecord->mail]
            , "totalTaxin" => ["value" => $orderTableRecord->total_taxin]
            , "items" => []
        ];
        $orderItems = \Packages\MvcSample\Models\OrderItem::getOrderItemById($orderTableRecord->order_table_id);
        foreach($orderItems as $orderItem) {
            $product = \Packages\MvcSample\Models\Product::
                            where("product_id", "=", $orderItem->product_id)->first();
            $order["items"][] = [
                  "quantity" => ["value" => $orderItem->quantity]
                , "priceTotalTaxin" => ["value" => $orderItem->price_total_taxin]
                , "product" => ["productName" => ["value" => $product->product_name]]
            ];
        }
        return $order;
    }
}
