<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Pyz\Zed\PriceImport\Persistence\Propel\Mapper\CustomerPriceProductMapper;

class PriceImportPersistenceFactory implements PriceImportPersistenceFactoryInterface
{

    public function createCustomerPriceProductQuery()
    {
        return PyzCustomerPriceProductQuery::create();
    }

    public function createCustomerPriceProductMapper()
    {
        return new CustomerPriceProductMapper();
    }
}
