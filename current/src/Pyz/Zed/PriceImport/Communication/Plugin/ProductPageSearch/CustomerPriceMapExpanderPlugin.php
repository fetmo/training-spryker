<?php


namespace Pyz\Zed\PriceImport\Communication\Plugin\ProductPageSearch;


use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class CustomerPriceMapExpanderPlugin implements ProductPageMapExpanderInterface
{
    public function expandProductPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer)
    {
        $customerPrices = $productData['customer_prices'];

        $pageMapTransfer->setCustomerPrices($customerPrices);
    }
}
