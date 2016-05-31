<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->_validator_UniqueMultiple();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function _validator_UniqueMultiple()
    {
        Validator::extend('unique_multiple', function ($attribute, $value, $parameters, $validator) {
            $table = array_shift($parameters);

            $query = \DB::table($table);

            foreach ($parameters as $i => $field) {
                $query->where($field, $validator->getData()[$field]);
            }

            // Validation result will be false if any rows match the combination
            return ($query->count() == 0);
        });
    }
}
