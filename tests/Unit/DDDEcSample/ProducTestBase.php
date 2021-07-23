<?php

namespace Tests\Unit\DDDEcSample;

use Tests\TestCase;
use Packages\DDDEcSample\Presentation\Product\{ProductViewData, ProductGroupViewData};

class ProducTestBase extends TestCase
{
    public function checkProduct(array $product)
    {
        $this->assertTrue(!is_null($product["productId"]["value"]));
        $this->assertTrue(!is_null($product["productGroupId"]["value"]));
        $this->assertString($product["productName"]["value"]);
        $this->assertTrue(!is_null($product["price"]["value"]));
        $this->assertTrue(!is_null($product["taxRate"]["value"]));
        $this->assertTrue(!is_null($product["color"]));
        $this->assertTrue(!is_null($product["color"]["colorId"]["value"]));
        $this->assertString($product["color"]["colorName"]["value"]);
        $this->assertTrue(!is_null($product["size"]));
        $this->assertTrue(!is_null($product["size"]["sizeId"]["value"]));
        $this->assertString($product["size"]["sizeName"]["value"]);
    }
    public function checkProductGroup(array $productGroup)
    {
        $this->assertTrue(!is_null($productGroup["productGroupId"]["value"]));
        $this->assertString($productGroup["productGroupName"]["value"]);
        $this->assertTrue(!is_null($productGroup["lowPrice"]["value"]));
        $this->assertTrue(!is_null($productGroup["heightPrice"]["value"]));
        $this->assertTrue(!is_null($productGroup["products"]));
        foreach($productGroup["products"] as $colorKey => $colorVal) {
            foreach($colorVal as $sizeKey => $product) {
                $this->checkProduct($product);
            }
        }
    $this->assertTrue(!is_null($productGroup["colors"]));
        foreach($productGroup["colors"] as $color) {
            /** @var ColorViewData $color */
            $this->assertTrue(!is_null($color["colorId"]["value"]));
            $this->assertString($color["colorName"]["value"]);
        }
        $this->assertTrue(!is_null($productGroup["sizes"]));
        foreach($productGroup["sizes"] as $size) {
            /** @var SizeViewData $size */
            $this->assertTrue(!is_null($size["sizeId"]["value"]));
            $this->assertString($size["sizeName"]["value"]);
        }
    }
}
