<?php
namespace Packages\MvcSample\Models;

/**
 * @property int $product_group_id
 * @property string $product_group_name
 * 
 * @method static static|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder getProductGroupQuery(?int $productGroupId = null)
 * @method static array getAll()
 * @method static array getProductGroupById(int $productGroupId)
 * @method static array productGroupDbToArray($records, bool $skipProducts)
 * @method static bool searchColorSizseArray(array $searchValues, string $strIdName, int $searchId)
 */
class ProductGroup extends ModelBase
{
	/**
	 * The table associated with the model.
	 * 
	 * @var string
	 */
	protected $table = 'test_schema.product_group';

	/**
	 * The primary key for the model.
	 * 
	 * @var string
	 */
	protected $primaryKey = 'product_group_id';

	/**
	 * @var array
	 */
	protected $fillable = ['product_group_name'];

	/**
	 * Indicates if the model should be timestamped.
	 * 
	 * @var bool
	 */
	public $timestamps = false;

	protected function getProductGroupQuery(?int $productGroupId = null) {
		//$productGroupQuery = new static;
		$productGroupQuery = \DB::table('test_schema.product_group');
		$productGroupQuery = $productGroupQuery->join("test_schema.product", "product.product_group_id", "=", "product_group.product_group_id")
			->join("test_schema.color", "product.color_id", "=", "color.color_id")
			->join("test_schema.size", "product.size_id", "=", "size.size_id")
			->orderBy("product.product_group_id", "ASC")
			->orderBy("product.color_id", "ASC")
			->orderBy("product.size_id", "ASC")
			->orderBy("product.product_id", "ASC");
		if (!is_null($productGroupId)) {
			$productGroupQuery = $productGroupQuery->where("product.product_group_id", "=", $productGroupId);
		}
		return $productGroupQuery;
    }

	protected function getAll() : array {
		$records = static::getProductGroupQuery()->cursor();
		return static::productGroupDbToArray($records, true);
	}
	protected function getProductGroupById(int $productGroupId) : array {
		$records = static::getProductGroupQuery($productGroupId)->cursor();
		$productGroups = static::productGroupDbToArray($records, false);
		if (0 < count($productGroups)) {
			return $productGroups[0];
		}
		return [];
	}

	protected function productGroupDbToArray($records, bool $skipProducts) : array {
		$productGroup = [];
		$productGroups = [];
		foreach($records as $record) {
			if (0 >= count($productGroup) || $productGroup["productGroupId"]["value"] !== $record->product_group_id) {
				if (0 < count($productGroup)) {
					$productGroups[] = $productGroup;
				}
				$productGroup = [];
				$productGroup["productGroupId"]["value"] = $record->product_group_id;
				$productGroup["productGroupId"]["value"] = $record->product_group_id;
				$productGroup["productGroupName"]["value"] = $record->product_group_name;
				$productGroup["lowPrice"]["value"] = $record->price;
				$productGroup["heightPrice"]["value"] = $record->price;
				$productGroup["lowPriceTaxIn"]["value"] = \Packages\MvcSample\Models\Product::calcPriceTaxIn($record->price, $record->tax_rate);
				$productGroup["heightPriceTaxIn"]["value"] = \Packages\MvcSample\Models\Product::calcPriceTaxIn($record->price, $record->tax_rate);
				$productGroup["products"] = [];
				$productGroup["colors"] = [];
				$productGroup["sizes"] = [];
			}
			$price = $record->price;
			$priceTaxIn = \Packages\MvcSample\Models\Product::calcPriceTaxIn($record->price, $record->tax_rate);
			if (!$skipProducts) {
				$productGroup["products"][$record->color_name][$record->size_name] =
					\Packages\MvcSample\Models\Product::productDbToArray($record);
			}
			if ($price < $productGroup["lowPrice"]["value"]) {
				$productGroup["lowPrice"]["value"] = $price;
			}
			if ($price > $productGroup["heightPrice"]["value"]) {
				$productGroup["heightPrice"]["value"] = $price;
			}
			if ($priceTaxIn < $productGroup["lowPriceTaxIn"]["value"]) {
				$productGroup["lowPriceTaxIn"]["value"] = $price;
			}
			if ($priceTaxIn > $productGroup["heightPriceTaxIn"]["value"]) {
				$productGroup["heightPriceTaxIn"]["value"] = $price;
			}
			if (!static::searchColorSizseArray(
				$productGroup["colors"], "colorId", $record->color_id)) {
				$productGroup["colors"][] = [
					"colorId" => ["value" => $record->color_id]
					, "colorName" => ["value" => $record->color_name]
				];
			}
			if (!static::searchColorSizseArray(
				$productGroup["sizes"], "sizeId", $record->size_id)) {
				$productGroup["sizes"][] = [
					"sizeId" => ["value" => $record->size_id]
					, "sizeName" => ["value" => $record->size_name]
				];
			}
		}
		if (0 < count($productGroup)) {
			$productGroups[] = $productGroup;
		}
		return $productGroups;
	}

	protected function searchColorSizseArray(array $searchValues, string $strIdName, int $searchId) :bool {
		$isExist = false;
		foreach($searchValues as $searchValue) {
			if ($searchValue[$strIdName]["value"] === $searchId) {
				$isExist = true;
				break;
			}
		}
		return $isExist;
	}
}
