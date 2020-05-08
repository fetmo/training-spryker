<?php


namespace Pyz\Client\PriceImport;


use Generated\Shared\Transfer\CustomerPriceProductTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\PriceImport\PriceImportFactory getFactory()
 */
class PriceImportClient extends AbstractClient
{

    /**
     * @param $idProductAbstract
     *
     * @return CustomerPriceProductTransfer[]|array
     */
    public function findPriceProductAbstractPrices($idAbstract): array
    {
        return $this->getFactory()->createPriceImportStorageReader()->findPriceProductAbstractPrices($idAbstract);
    }

}