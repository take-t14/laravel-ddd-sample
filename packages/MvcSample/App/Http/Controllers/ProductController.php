<?php
namespace Packages\MvcSample\App\Http\Controllers;

use Packages\MvcSample\App\Http\Controllers\ControllerBase;

class ProductController extends ControllerBase
{
	public function list() {
		return $this->getView("viewModel"
			, ["productGroups" => \Packages\MvcSample\Models\ProductGroup::getAll()]);
	}
	public function detail() {
		return $this->getView("viewModel"
			, ["productGroup" => \Packages\MvcSample\Models\ProductGroup::getProductGroupById((int)\RequestEx::get("productGroupId"))
			, "reviews" => \Packages\MvcSample\Models\Review::getReviewsByProductGroupId((int)\RequestEx::get("productGroupId"))
		]);
	}
}
