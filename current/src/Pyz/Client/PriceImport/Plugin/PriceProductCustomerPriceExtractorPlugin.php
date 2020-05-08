<?php


namespace Pyz\Client\PriceImport\Plugin;


use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface;

/**
 * @method \Pyz\Client\PriceImport\PriceImportClient getClient()
 */
class PriceProductCustomerPriceExtractorPlugin extends AbstractPlugin implements PriceProductStoragePricesExtractorPluginInterface
{

    /**
     * {@inheritDoc}
     */
    public function extractProductPricesForProductAbstract(array $priceProductTransfers): array
    {
        /** @var \Generated\Shared\Transfer\PriceProductTransfer $priceProductTransfer */
        foreach ($priceProductTransfers as $priceProductTransfer) {
            $productId = $priceProductTransfer->getIdProductAbstract();
            $prices = $this->getClient()->findPriceProductAbstractPrices($productId);

            $amount = -1;
            if (count($prices) > 0) {
                $amount = $prices[0]->getPrice();
            }

            if ($amount >= 0) {
                $priceProductTransfer
                    ->getMoneyValue()
                        ->setNetAmount($amount)
                        ->setGrossAmount($amount);
            }
        }

        return $priceProductTransfers;
    }

    /**
     * {@inheritDoc}
     */
    public function extractProductPricesForProductConcrete(int $idProductConcrete, array $priceProductTransfers): array
    {
        return $this->extractProductPricesForProductAbstract($priceProductTransfers);
    }

}