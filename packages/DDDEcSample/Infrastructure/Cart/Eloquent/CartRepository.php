<?php
namespace Packages\DDDEcSample\Infrastructure\Cart\Eloquent;

use Packages\DDDEcSample\Domain\Model\Cart\Entity\{Cart, CartItem};
use Packages\DDDEcSample\UseCase\Cart\ICartRepository;
use Packages\DDDEcSample\Domain\Model\Cart\VO\{CartId};
use Packages\DDDEcSample\Domain\Model\Common\VO\UpdDate;
use Packages\DDDEcSample\Domain\Model\Product\Entity\Product;
use Packages\DDDEcSample\Domain\Model\Common\Price\VO\{Quantity};

/**
 * class CartRepository
 * 
 */
class CartRepository implements ICartRepository
{
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function find() : ?Cart {
    if (!\SessionRepository::has('dddCartId')) {
      return null;
    }
    /** @var CartId $cartId */
    $cartId = \SessionRepository::get('dddCartId');
    if (!isset($cartId) || is_null($cartId->getValue())) {
      return null;
    }
    $cartItemsQuery = \DB::table('test_schema.cart');
    $cartItemsQuery->join("test_schema.cart_item", "cart.cart_id", "=", "cart_item.cart_id");
    $cartItemsQuery->join("test_schema.product", "cart_item.product_id", "=", "product.product_id");
    $cartItemsQuery->join("test_schema.color", "product.color_id", "=", "color.color_id");
    $cartItemsQuery->join("test_schema.size", "product.size_id", "=", "size.size_id");
    $cartItemsQuery->where("cart.cart_id", "=", $cartId->getValue());
    $cartItemsRec = $cartItemsQuery->get();
    if (0 >= count($cartItemsRec)) {
      return null;
    }
    $cart = new Cart(
      new CartId($cartItemsRec[0]->cart_id)
      , new UpdDate($cartItemsRec[0]->upd_date)
    );
    
    foreach ($cartItemsRec as $recCartItem) {
      $cartItem = new CartItem($cart->getCartId()
        , Product::dbRecordToModel($recCartItem)
        , new Quantity($recCartItem->quantity)
      );
      $cart->addCartItem($cartItem);
    }
    return $cart;
  }
  public function newEmptyCart() : Cart {
    return new Cart(new CartId($this->nextVal()));
  }
  private function nextVal() : int {
    $result = \DB::selectOne("SELECT nextval('test_schema.cart_cart_id_seq') as nextval");
    return $result->nextval;
  }
  /**
   * 
   *
   * @abstract
   * @access public
   */
  public function save(Cart $cart) : Cart {
    \DB::table("test_schema.cart")->updateOrInsert(
        ["cart_id" => $cart->getCartId()->getValue()]
      ,["upd_date" => $cart->getUpdDate()->getValue()
      , "total" => $cart->getTotal()->getValue()
      , "total_taxin" => $cart->getTotalTaxin()->getValue()
    ]);
    \DB::table("test_schema.cart_item")->where("cart_id", "=", $cart->getCartId()->getValue())->delete();
    $retCart = new Cart($cart->getCartId(), $cart->getUpdDate());
    foreach($cart->getCartItems() as $cartItem) {
      /** @var CartItem $cartItem */
      if (0 >= $cartItem->getQuantity()->getValue()) {
        continue;
      }
      \DB::table("test_schema.cart_item")->insert([
          "cart_id" => $cart->getCartId()->getValue()
        , "product_id" => $cartItem->getProduct()->getProductId()->getValue()
        , "quantity" => $cartItem->getQuantity()->getValue()
        , "price_total" => $cartItem->getPriceTotal()->getValue()
        , "price_taxin" => $cartItem->getPriceTaxIn()->getValue()
        , "price_total_taxin" => $cartItem->getPriceTotalTaxin()->getValue()
      ]);
      $retCart->addCartItem(
        new CartItem(
            $cart->getCartId()
          , $cartItem->getProduct()
          , $cartItem->getQuantity()
        )
      );
    }
    \SessionRepository::put('dddCartId', $retCart->getCartId());
    return $retCart;
  }
}