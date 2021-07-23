<?php
namespace Packages\LightDDDEcSample\Domain\Model\Cart\Entity;

use Packages\LightDDDEcSample\Domain\Model\Cart\VO\CartId;
use Packages\LightDDDEcSample\Domain\Model\Common\VO\UpdDate;
use Packages\LightDDDEcSample\Domain\Model\Product\VO\ProductId;
use Illuminate\Support\Collection;
use Packages\LightDDDEcSample\Domain\Model\Common\Price\VO\{OrderBase, Total, TotalTaxin};
use Packages\LightDDDEcSample\InterfaceAdapters\Presenters\ViewModelTrait;
use Illuminate\Contracts\Support\Arrayable;

/**
 * class Cart
 * 
 */
class Cart extends OrderBase implements Arrayable
{
  use ViewModelTrait;
  /** @var CartId */
  private $cartId = null;
  /** @var UpdDate */
  private $updDate = null;
  function __construct(?CartId $cartId, ?UpdDate $updDate = null) {
    parent::__construct();
    $this->cartId = $cartId;
    $this->updDate = !is_null($updDate) ? $updDate : new UpdDate();
  }
  function getCartId() : ?CartId {
    return $this->cartId;
  }
  function getUpdDate() : UpdDate {
    return $this->updDate;
  }
  function getCartItems() : Collection {
    return $this->getItems();
  }
  function removeCartItem(ProductId $productId, bool $bCalc = false) {
    // 指定されたproductIdの商品を削除
    $this->items = $this->items->filter(function ($value, $key) use($productId) {
      /** @var CartItem $value */
      return $value->getProduct()->getProductId()->getValue() !== $productId->getValue();
    });
    if ($bCalc) {
      $this->calc();
    }
  }
  function addCartItem(CartItem $cartItem) {
    // 同じ商品があれば取り出す
    $addedItems = $this->items->filter(function ($value, $key) use($cartItem) {
      /** @var CartItem $value */
      return $value->getProduct()->equal($cartItem->getProduct());
    });
    // 同じ商品があれば削除しておく
    $this->removeCartItem($cartItem->getProduct()->getProductId());
    // 同じ商品が追加済みの場合
    /** @var CartItem $addItem */
    $addItem = null;
    if (0 < count($addedItems)) {
      // 数量を計算して変更
      $addItem = $addedItems->first();
      $addItem->addQuantity($cartItem->getQuantity());
    } else {
      $addItem = $cartItem;
    }
    // 数量が0以下の場合は商品追加しない（削除となる）
    if (0 >= $addItem->getQuantity()->getValue()) {
      return;
    }
    $this->items->push($addItem);
    $this->items = $this->items
      ->sortBy(function(CartItem $cartItem) {
        return $cartItem->getProduct()->getProductId()->getValue();
      })->sortBy(function(CartItem $cartItem) {
        return $cartItem->getProduct()->getProductName()->getValue();
      });
    $this->calc();
  }
  function allRemoveItem() {
    $this->items = new Collection();
  }
}