<?php


namespace Pyz\Client\Search\Model\Elasticsearch\AggregationExtractor;

use Pyz\Shared\Search\SearchConfig;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Search\Model\Elasticsearch\AggregationExtractor\AggregationExtractorFactory as SprykerAggregationExtractorFactory;

class AggregationExtractorFactory extends SprykerAggregationExtractorFactory
{

    /**
     * {@inheritDoc}
     */
    protected function createByType(FacetConfigTransfer $facetConfigTransfer)
    {
        if ($facetConfigTransfer->getType() === SearchConfig::FACET_TYPE_CUSTOMER_PRICE_RANGE) {
            $extractor = $this->createCustomerPriceRangeExtractor($facetConfigTransfer);
        } else {
            $extractor = parent::createByType($facetConfigTransfer);
        }

        return $extractor;
    }

    protected function createCustomerPriceRangeExtractor(FacetConfigTransfer $facetConfigTransfer)
    {
        return new CustomerPriceRangeExtractor($facetConfigTransfer, $this->createMoneyPlugin());
    }
}
