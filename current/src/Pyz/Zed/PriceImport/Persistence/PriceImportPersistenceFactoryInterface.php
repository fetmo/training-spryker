<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Pyz\Zed\PriceImport\Persistence\Propel\Mapper\CustomerPriceProductMapper;

interface PriceImportPersistenceFactoryInterface
{

    public function createCustomerPriceProductMapper();

    public function createCustomerPriceProductQuery();
}