<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportPersistenceFactory getFactory()
 */
class PriceImportRepository extends AbstractRepository
{

    public function findCustomerPriceByTransfer(CustomerPriceProductTransfer $transfer)
    {
        $query = $this->getFactory()->createCustomerPriceProductQuery();
        $query->filterByCustomerNumber($transfer->getCustomerNumber())
            ->filterByProductNumber($transfer->getProductNumber())
            ->filterByQuantity($transfer->getQuantity());

        $result = $query->findOneOrCreate();

        return $this->getFactory()->createCustomerPriceProductMapper()->mapEntityToTransfer($result);
    }

    public function fetchCustomerPricesByCustomerNo(string $customerNo)
    {
        $query = $this->getFactory()->createCustomerPriceProductQuery();
        $query->filterByCustomerNumber($customerNo);

        return $query->find()->getData();
    }

}