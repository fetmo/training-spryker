<?php


namespace Pyz\Zed\PriceImport\Communication\Plugin\ProductPageSearch;


use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Generated\Shared\Transfer\ProductPayloadTransfer;
use Spryker\Shared\ProductPageSearch\ProductPageSearchConfig;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

class CustomerPriceDataLoaderExpanderPlugin implements ProductPageDataExpanderInterface
{
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer)
    {
        $payload = $this->getProductPayloadTransfer($productData);

        $price = $productAbstractPageSearchTransfer->getPrice();
        $customerPrices = $payload->getCustomerPrices();

        $productAbstractPageSearchTransfer->setCustomerPrices(
            $this->mergePrices($price, $customerPrices)
        );
    }

    protected function mergePrices(?int $price, \ArrayObject $customerPrices)
    {
        $priceSets = [
            [
                'customer-number' => 'DEFAULT',
                'price' => $price ?? 0
            ]
        ];

        /** @var \Generated\Shared\Transfer\CustomerPriceProductTransfer $customerPrice */
        foreach ($customerPrices->getArrayCopy() as $customerPrice) {
            if ($customerPrice->getQuantity() === 1){
                $priceSets[] = [
                    'customer-number' => $customerPrice->getCustomerNumber(),
                    'price' => $customerPrice->getPrice() * 100
                ];
            }
        }

        return $priceSets;
    }

    /**
     * @param array $productData
     *
     * @return \Generated\Shared\Transfer\ProductPayloadTransfer
     */
    protected function getProductPayloadTransfer(array $productData): ProductPayloadTransfer
    {
        return $productData[ProductPageSearchConfig::PRODUCT_ABSTRACT_PAGE_LOAD_DATA];
    }
}
