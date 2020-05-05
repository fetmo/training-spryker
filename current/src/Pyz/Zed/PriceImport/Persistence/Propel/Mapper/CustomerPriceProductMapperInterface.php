<?php


namespace Pyz\Zed\PriceImport\Persistence\Propel\Mapper;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProduct;

interface CustomerPriceProductMapperInterface
{

    public function mapResults(array $results): CustomerPriceProductListTransfer;

    public function mapEntityToTransfer(PyzCustomerPriceProduct $priceProduct): CustomerPriceProductTransfer;

}