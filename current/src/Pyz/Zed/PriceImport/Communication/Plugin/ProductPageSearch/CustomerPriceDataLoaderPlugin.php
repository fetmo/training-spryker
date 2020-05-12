<?php


namespace Pyz\Zed\PriceImport\Communication\Plugin\ProductPageSearch;


use Generated\Shared\Transfer\ProductPageLoadTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductPageDataLoaderPluginInterface;

/**
 * @method \Pyz\Zed\PriceImport\Business\PriceImportFacade getFacade()
 * @method \Pyz\Zed\PriceImport\Persistence\PriceImportRepository getRepository()
 */
class CustomerPriceDataLoaderPlugin extends AbstractPlugin implements ProductPageDataLoaderPluginInterface
{
    public function expandProductPageDataTransfer(ProductPageLoadTransfer $loadTransfer)
    {
        $payloads = $loadTransfer->getPayloadTransfers();

        /** @var \Generated\Shared\Transfer\ProductPayloadTransfer $payload */
        foreach ($payloads as $payload) {
            $payload->setCustomerPrices(
                $this->fetchCustomerPrices($payload->getIdProductAbstract())
            );
        }

        $loadTransfer->setPayloadTransfers($payloads);

        return $loadTransfer;
    }

    protected function fetchCustomerPrices(int $idProductAbstract)
    {
        $productList = $this->getRepository()->fetchCustomerPricesByAbstractId($idProductAbstract);

        return $productList->getItems();
    }
}
