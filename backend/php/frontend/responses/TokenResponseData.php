<?php

namespace frontend\responses;

use yii\helpers\ArrayHelper;

class TokenResponseData
{
    /**
     * @param []|null $object
     *
     * @return array|null
     */
    public static function render($object): ?array
    {
        if (empty($object)) {
            return $object;
        }
        $properties = [
            // Company::class => [
            //     'id',
            //     'name',
            //     'address_id',
            //     'phone',
            //     'email',
            //     'city_id',
            //     'metro_id',
            //     'metro_mcc_id',
            //     'district_id',
            //     'area_id',
            //     'description',
            //     'price_per_hour',
            //     'created_at',
            //     'updated_at',
            // ],
        ];
        return ArrayHelper::toArray($object, $properties);;
    }
}