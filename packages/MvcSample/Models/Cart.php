<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $cart_id
 * @property int $total
 * @property int $total_taxin
 * @property string $upd_date
 * @method static mixed addCart(int $productId, int $quantity)
 * @method static array getCart()
 * @method static array cartDbToArray($record)
 * @method static mixed removeCartItem(int $productId)
 * @method static mixed removeCartItemAll()
 * @method static mixed updateCartPrice(int $cartId)
 */
class Cart extends ModelBase
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'test_schema.cart';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cart_id';

    /**
     * @var array
     */
    protected $fillable = ['total', 'total_taxin', 'upd_date'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    protected function addCart(int $productId, int $quantity) {
        return \DB::transaction(function() use($productId, $quantity) {
            $cartId = null;
            $cart = null;
            $product = \Packages\MvcSample\Models\Product::find($productId);
            $priceTaxIn = Product::calcPriceTaxIn($product->price, $product->tax_rate);
            if (!isset($product)) {
                abort(404);
            }
            if (\SessionRepository::has("mvcCartId")) {
                $cartId = \SessionRepository::get("mvcCartId");
                $cart = static::where("cart_id", "=", $cartId)->first();
                $cartItem = \Packages\MvcSample\Models\CartItem
                    ::where("cart_id", "=", $cartId)
                    ->where("product_id", "=", $productId)
                    ->first();
                if (isset($cart) && isset($cartItem)) {
                    $quantity += $cartItem->quantity;
                }
            } else {
                $cart = new static;
                $cart->fill([
                      "total" => $product->price * $quantity
                    , "total_taxin" => $priceTaxIn * $quantity
                    , "upd_date" => date('Y-m-d H:i:s')
                ])->save();
            }
            if (!isset($cart)) {
                abort(404);
            }
            \Packages\MvcSample\Models\CartItem::updateOrInsert([
                  "cart_id" => $cart->cart_id
                , "product_id" => $productId
            ], [
                  "quantity" => $quantity
                , "price_total" => $product->price * $quantity
                , "price_taxin" => $priceTaxIn
                , "price_total_taxin" => $priceTaxIn * $quantity
            ]);
            static::updateCartPrice($cart->cart_id);
            $retCart = static::cartDbToArray(
                static::where("cart_id", "=", $cart->cart_id)->first());
            \SessionRepository::put("mvcCartId", $cart->cart_id);
            return $retCart;
        });
    }
    protected function removeCartItem(int $productId) {
        \DB::transaction(function() use($productId) {
            if (!\SessionRepository::has("mvcCartId")) {
                return;
            }
            $cartId = \SessionRepository::get("mvcCartId");
            \Packages\MvcSample\Models\CartItem::where("cart_id", "=", $cartId)
                ->where("product_id", "=", $productId)
                ->delete();
            static::updateCartPrice($cartId);
        });
    }
    protected function removeCartItemAll() {
        \DB::transaction(function() {
            if (!\SessionRepository::has("mvcCartId")) {
                return;
            }
            $cartId = \SessionRepository::get("mvcCartId");
            \Packages\MvcSample\Models\CartItem::where("cart_id", "=", $cartId)
                ->delete();
            static::updateCartPrice($cartId);
        });
    }
    protected function updateCartPrice(int $cartId) {
        $cartItems = \Packages\MvcSample\Models\CartItem::where("cart_id", "=", $cartId)->get();
        $total = 0;
        $totalTaxIn = 0;
        foreach($cartItems as $cartItem) {
            $total += $cartItem->price_total;
            $totalTaxIn += $cartItem->price_total_taxin;
        }
        \DB::table('test_schema.cart')->updateOrInsert([
              "cart_id" => $cartId
        ],[
              "total" => $total
            , "total_taxin" => $totalTaxIn
        ]);
    }
    protected function getCart() : array {
        $cartId = null;
        $cartItemsRec = null;
        if (\SessionRepository::has("mvcCartId")) {
            $cartId = \SessionRepository::get("mvcCartId");
            $cartItemsQuery = \DB::table('test_schema.cart');
            $cartItemsQuery->where("cart.cart_id", "=", $cartId);
            $cartItemsRec = $cartItemsQuery->first();
        }
        return self::cartDbToArray($cartItemsRec);
    }
    protected function cartDbToArray($record = null) : array {
        $cart = [
            "cartId" => ["value" => null]
            , "updDate" => ["value" => ""]
            , "total" => ["value" => 0]
            , "totalTaxin" => ["value" => 0]
            , "items" => []
        ];
        if (is_null($record)) {
            return $cart;
        }
        $cart["cartId"] = ["value" => $record->cart_id];
        $cart["updDate"] = ["value" => $record->upd_date];
        $cart["total"] = ["value" => $record->total];
        $cart["totalTaxin"] = ["value" => $record->total_taxin];
        $cart["items"] = \Packages\MvcSample\Models\CartItem::makeCartItemByCartId($record->cart_id);
        return $cart;
    }

}
