<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Generated\Shared\Transfer\PyzCustomerPriceProductEntityTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class PriceImportEntityManager extends AbstractEntityManager
{

    public function saveEntity(CustomerPriceProductTransfer $priceProductTransfer)
    {
        $priceProduct = $this->transferTransferToTransfer(new PyzCustomerPriceProductEntityTransfer(), $priceProductTransfer);

        $priceProduct = $this->save($priceProduct);

        return $this->transferTransferToTransfer(new CustomerPriceProductTransfer(), $priceProduct);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transferA
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transferB
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function transferTransferToTransfer(AbstractTransfer $transferA, AbstractTransfer $transferB)
    {
        $transferA->fromArray($transferB->toArray(), true);
        return $transferA;
    }
}
