<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Generated\Shared\Transfer\CustomerPriceProductListTransfer;
use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Orm\Zed\CustomerPriceProduct\Persistence\Map\PyzCustomerPriceProductTableMap;
use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

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

    public function fetchCustomerPricesByCustomerNoAndProductNo(string $customerNo, string $productNo): CustomerPriceProductListTransfer
    {
        $query = $this->getFactory()->createCustomerPriceProductQuery();
        $query->filterByCustomerNumber($customerNo)
            ->filterByProductNumber($productNo);

        $results = $query->find()->getData();

        return $this->getFactory()->createCustomerPriceProductMapper()->mapResults($results);
    }

    public function fetchCustomerPricesByAbstractId(int $productAbstractId)
    {
        $query = $this->getFactory()->createCustomerPriceProductQuery();
        $query->filterByProductNumber((string)$productAbstractId);

        $results = $query->find()->getData();

        return $this->getFactory()->createCustomerPriceProductMapper()->mapResults($results);
    }
}