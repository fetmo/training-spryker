<?php


namespace Pyz\Client\PriceImport;


use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\PriceImport\PriceImportFactory getFactory()
 */
class PriceImportClient extends AbstractClient
{

    public function findPriceProductAbstractPrices($idAbstract)
    {
        return $this->getFactory()->createPriceImportStorageReader()->findPriceProductAbstractPrices($idAbstract);
    }
    
}