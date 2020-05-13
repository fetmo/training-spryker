<?php


namespace Pyz\Client\Search;

use Pyz\Client\Search\Model\Elasticsearch\Aggregation\FacetAggregationFactory;
use Pyz\Client\Search\Model\Elasticsearch\AggregationExtractor\AggregationExtractorFactory;
use Spryker\Client\Search\SearchFactory as SprykerSearchFactory;

class SearchFactory extends SprykerSearchFactory
{

    public function createAggregationExtractorFactory()
    {
        return new AggregationExtractorFactory();
    }

    public function createFacetAggregationFactory()
    {
        return new FacetAggregationFactory(
            $this->createPageIndexMap(),
            $this->createAggregationBuilder(),
            $this->getConfig(),
            $this->getCustomerClient()
        );
    }

    protected function getCustomerClient()
    {
        return $this->getProvidedDependency(SearchDependencyProvider::CLIENT_CUSTOMER);
    }

}
