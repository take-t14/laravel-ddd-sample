<?php
namespace Packages\MvcSample\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ControllerBase extends Controller
{
    /*
    protected function getView(string $strViewModelName, array $getMethodNames, array $datas
		, string $strMethodName2 = "toArray") : View {
		$urlPrefix = "mvc";
		$viewModel = \Packages\MvcSample\Models\ModelBase::getViewModel($getMethodNames, $datas, $strMethodName2);
		return view(\RequestEx::getRoute()->getName(), [
            $strViewModelName => $viewModel
            , "urlPrefix" => $urlPrefix
        ]);
    }*/
    protected function getView(string $strViewModelName, array $datas) : View {
        $urlPrefix = "mvc";
        return view(\RequestEx::getRoute()->getName(), [
            $strViewModelName => $datas, "urlPrefix" => $urlPrefix
        ]);
    }
}
