<?php


namespace Pyz\Client\Search\Model\Elasticsearch\AggregationExtractor;

use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Search\Model\Elasticsearch\AggregationExtractor\AggregationExtractorFactory as SprykerAggregationExtractorFactory;

class AggregationExtractorFactory extends SprykerAggregationExtractorFactory
{

    /**
     * {@inheritDoc}
     */
    protected function createByType(FacetConfigTransfer $facetConfigTransfer)
    {
        $extractor = parent::createByType($facetConfigTransfer);

        if ($extractor === null && $facetConfigTransfer->getType() === 'CUSTOMER_PRICE_RANGE') {

        }

        return $extractor;
    }

}