<?php


namespace Pyz\Client\Search\Model\Elasticsearch\Query;

use Pyz\Shared\Search\SearchConfig;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface;
use Spryker\Client\Search\Model\Elasticsearch\Query\QueryFactory as SprykerQueryFactory;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;

class QueryFactory extends SprykerQueryFactory
{


    /**
     * @var \Spryker\Client\Customer\CustomerClientInterface
     */
    protected $customerClient;

    /**
     * @param \Spryker\Client\Search\Model\Elasticsearch\Query\QueryBuilderInterface $queryBuilder
     * @param \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface $moneyPlugin
     * @param \Spryker\Client\Customer\CustomerClientInterface $customerClient
     */
    public function __construct(QueryBuilderInterface $queryBuilder, MoneyPluginInterface $moneyPlugin, CustomerClientInterface $customerClient)
    {
        parent::__construct($queryBuilder, $moneyPlugin);

        $this->customerClient = $customerClient;
    }

    protected function __createByFacetType(FacetConfigTransfer $facetConfigTransfer, $filterValue)
    {
        if($facetConfigTransfer->getType() === SearchConfig::FACET_TYPE_CUSTOMER_PRICE_RANGE){
            $query = $this->createCustomerPriceQuery($facetConfigTransfer, $filterValue)->getQuery();
        }else{
            $query = parent::createByFacetType($facetConfigTransfer, $filterValue);
        }

        return $query;
    }

    protected function createCustomerPriceQuery(FacetConfigTransfer $facetConfigTransfer, $filterValue)
    {
        return new CustomerPriceRangeQuery($facetConfigTransfer, $filterValue, $this->customerClient);
    }

}