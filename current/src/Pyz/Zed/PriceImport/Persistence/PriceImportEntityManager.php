<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Generated\Shared\Transfer\PyzCustomerPriceProductEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class PriceImportEntityManager extends AbstractEntityManager
{

    public function saveEntity(CustomerPriceProductTransfer $priceProductTransfer)
    {
        $priceProduct = new PyzCustomerPriceProductEntityTransfer();
        $priceProduct->fromArray($priceProductTransfer->toArray(), true);

        $this->save($priceProduct);
    }
}
