<?php


namespace Pyz\Zed\PriceImport\Business;


use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\PriceImport\Business\PriceImportBusinessFactory getFactory()
 */
class PriceImportFacade extends AbstractFacade
{

    public function runImport(string $path)
    {
        $this->getFactory()->createImporter()->import($path);
    }
}
