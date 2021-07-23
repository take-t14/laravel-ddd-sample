<?php
namespace Packages\MvcSample\Models;

use Packages\MvcSample\App\Http\Controllers\MyObject;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * @method static MyObject getViewModel(array $getMethodNames, array $datas, string $strMethodName2 = "toArray")
 */
class ModelBase extends Model
{
    protected function getViewModel(array $getMethodNames, array $datas
        , string $strMethodName2 = "toArray") : MyObject {
        if (count($getMethodNames) != count($datas)) {
            throw new InvalidArgumentException("メソッド名とデータの数は同じ数を設定して下さい");
        }
        if (0 >= count($getMethodNames)) {
            throw new InvalidArgumentException("メソッド名とデータを設定して下さい");
        }
        $viewModel = new MyObject();
        foreach($getMethodNames as $key => $getMethodName) {
            $viewModel->addMethod($getMethodName, function () use($datas, $key, $strMethodName2) {
                $toArray = new MyObject();
                $toArray->addMethod($strMethodName2, function () use($datas, $key) {
                    return $datas[$key];
                });
                return $toArray;
            });
        }
        return $viewModel;
    }

}
