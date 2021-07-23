<?php

namespace Packages\MvcSample\App\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\MvcSample\App\Libs\CustomValidator;

class CustomValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }
}
