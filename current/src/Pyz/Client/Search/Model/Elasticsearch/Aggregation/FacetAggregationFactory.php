<?php


namespace Pyz\Client\Search\Model\Elasticsearch\Aggregation;

use Generated\Shared\Transfer\FacetConfigTransfer;
use Pyz\Shared\Search\SearchConfig;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Search\Model\Elasticsearch\Aggregation\AggregationBuilderInterface;
use Spryker\Client\Search\Model\Elasticsearch\Aggregation\FacetAggregationFactory as SprykerFacetAggregationFactory;
use Spryker\Client\Search\SearchConfig as ClientSearchConfig;
use Spryker\Shared\Search\IndexMapInterface;

class FacetAggregationFactory extends SprykerFacetAggregationFactory
{

    /**
     * @var \Spryker\Client\Customer\CustomerClientInterface
     */
    protected $customerClient;

    /**
     * @param \Spryker\Shared\Search\IndexMapInterface $indexMap
     * @param \Spryker\Client\Search\Model\Elasticsearch\Aggregation\AggregationBuilderInterface $aggregationBuilder
     * @param \Spryker\Client\Search\SearchConfig $searchConfig
     * @param \Spryker\Client\Customer\CustomerClientInterface $customerClient
     */
    public function __construct(IndexMapInterface $indexMap, AggregationBuilderInterface $aggregationBuilder, ClientSearchConfig $searchConfig, CustomerClientInterface $customerClient)
    {
        parent::__construct($indexMap, $aggregationBuilder, $searchConfig);

        $this->customerClient = $customerClient;
    }

    protected function createByFacetType(FacetConfigTransfer $facetConfigTransfer)
    {
        if ($facetConfigTransfer->getType() === SearchConfig::FACET_TYPE_CUSTOMER_PRICE_RANGE) {
            return $this->createCustomerPriceAggregation($facetConfigTransfer);
        }

        return parent::createByFacetType($facetConfigTransfer);
    }

    protected function createCustomerPriceAggregation(FacetConfigTransfer $facetConfigTransfer)
    {
        return new CustomerPriceAggregation(
            $facetConfigTransfer,
            $this->customerClient
        );
    }
}
