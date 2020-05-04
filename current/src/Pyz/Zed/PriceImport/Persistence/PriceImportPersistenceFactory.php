<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;

class PriceImportPersistenceFactory
{

    public function createCustomerPriceProductQuery()
    {
        return PyzCustomerPriceProductQuery::create();
    }

}