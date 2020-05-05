<?php


namespace Pyz\Zed\PriceImport\Business;


use Pyz\Zed\PriceImport\Business\Model\JsonImporter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportEntityManager getEntityManager()
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportRepository getRepository()
 */
class PriceImportBusinessFactory extends AbstractBusinessFactory
{

    public function createImporter(): JsonImporter
    {
        return new JsonImporter(
            $this->getEntityManager(),
            $this->getRepository()
        );
    }

}