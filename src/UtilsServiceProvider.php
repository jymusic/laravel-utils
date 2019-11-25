<?php

namespace JYmusic\Utils;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use JYmusic\Utils\JavaScript\Transformer;

class UtilsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('utils', function() {
            return  new Util();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/utils.php',
            'utils'
        );
    }

    /**
     * Publish the plugin configuration.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/utils.php' => config_path('uitls.php')
        ]);

        // 添加自定义验证
        $this->extendValidator();
    }

    /**
     * 自定义验证规则
     *
     * @return void
     */
    protected function extendValidator()
    {
        // 添加自定义验证规则,允许字母和 - _
        Validator::extend('allow_letter', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) && preg_match('/^[a-zA-Z_-]+$/u', $value);
        });

        // 添加自定义验证规则,允许字和数字
        Validator::extend('allow_num', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) && preg_match('/^[a-zA-Z0-9]+$/u', $value);
        });

        // 添加验证手机号码
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            return is_numeric($value) && preg_match('/^1[3-9]\d{9}$/', $value);
        });

        // 添加验证中文
        Validator::extend('chinese', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) && preg_match('/^[\x7f-\xff]+$/', $value);
        });
    }
}
