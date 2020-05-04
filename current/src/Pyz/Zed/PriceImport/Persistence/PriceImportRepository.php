<?php


namespace Pyz\Zed\PriceImport\Persistence;


use Orm\Zed\CustomerPriceProduct\Persistence\PyzCustomerPriceProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportPersistenceFactory getFactory()
 */
class PriceImportRepository extends AbstractRepository
{

    public function fetchCustomerPricesByCustomerNo(string $customerNo)
    {
        $query = $this->getFactory()->createCustomerPriceProductQuery();
        $query->filterByCustomerNumber($customerNo);

        return $query->find()->getData();
    }

}