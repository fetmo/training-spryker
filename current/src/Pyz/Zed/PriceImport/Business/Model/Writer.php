<?php


namespace Pyz\Zed\PriceImport\Business\Model;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager;

class Writer
{

    /**
     * @var \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager
     */
    private $entityManager;

    /**
     * @param \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager $entityManager
     */
    public function __construct(PriceImportEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerPriceProductListTransfer $transfer
     */
    public function write(CustomerPriceProductListTransfer $transfer)
    {
        foreach ($transfer->getItems() as $item) {
            $this->writeEntity($item);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerPriceProductTransfer $customerPriceProductTransfer
     */
    protected function writeEntity(CustomerPriceProductTransfer $customerPriceProductTransfer)
    {
        $this->entityManager->saveEntity($customerPriceProductTransfer);
    }

}