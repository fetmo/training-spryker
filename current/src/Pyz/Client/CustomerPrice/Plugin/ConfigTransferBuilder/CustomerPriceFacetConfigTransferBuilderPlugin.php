<?php


namespace Pyz\Client\CustomerPrice\Plugin\ConfigTransferBuilder;

use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Catalog\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface;
use Pyz\Shared\Search\SearchConfig;

class CustomerPriceFacetConfigTransferBuilderPlugin implements FacetConfigTransferBuilderPluginInterface
{
    private const FIELD_NAME = PageIndexMap::CUSTOMER_PRICES;

    public function build()
    {
        return (new FacetConfigTransfer())
            ->setName(static::FIELD_NAME)
            ->setParameterName(static::FIELD_NAME)
            ->setFieldName(PageIndexMap::CUSTOMER_PRICES)
            ->setType(SearchConfig::FACET_TYPE_CUSTOMER_PRICE_RANGE);
    }
}
