<?php


namespace Pyz\Zed\PriceImport\Persistence\Propel\Mapper;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProduct;

class CustomerPriceProductMapper implements CustomerPriceProductMapperInterface
{

    public function mapResults(array $results): CustomerPriceProductListTransfer
    {
        $priceList = new CustomerPriceProductListTransfer();

        foreach ($results as $result) {
            $priceList->addItems($this->mapEntityToTransfer($result));
        }

        return $priceList;
    }

    public function mapEntityToTransfer(PyzCustomerPriceProduct $priceProduct): CustomerPriceProductTransfer
    {
        $priceProductTransfer = new CustomerPriceProductTransfer();
        $priceProductTransfer->fromArray($priceProduct->toArray(), true);

        return $priceProductTransfer;
    }

}