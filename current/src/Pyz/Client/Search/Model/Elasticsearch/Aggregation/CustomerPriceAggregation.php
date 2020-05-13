<?php


namespace Pyz\Client\Search\Model\Elasticsearch\Aggregation;


use Elastica\Aggregation\Stats;
use Elastica\Script\Script;
use Generated\Shared\Transfer\FacetConfigTransfer;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Search\Model\Elasticsearch\Aggregation\AbstractFacetAggregation;

class CustomerPriceAggregation extends AbstractFacetAggregation
{

    protected $facetConfig;

    protected $customerClient;

    public function __construct(FacetConfigTransfer $facetConfigTransfer, CustomerClientInterface $customerClient)
    {
        $this->facetConfig = $facetConfigTransfer;
        $this->customerClient = $customerClient;
    }

    public function createAggregation()
    {
        $custom = new Stats($this->facetConfig->getName());
        $scriptInline = "
            def customerPrice = 0; def defaultPrice = 0;
            if (params._source.containsKey('customer-prices') ) { 
                for(priceItem in params._source['customer-prices']) { 
                    if (priceItem['customer-number'] == params.customerNumber) { 
                        customerPrice = priceItem['price']; 
                    } else if (priceItem['customerNumber'] == 'DEFAULT') {
                        defaultPrice = priceItem['price'];
                    }
                } 
            }
            
            if (customerPrice > 0) {
               return customerPrice;
            } else {
               return defaultPrice;
            }
        ";
        $parameters = [
            'customerNumber' => $this->getCustomerId()
        ];
        $script = new Script(str_replace("\n", '', $scriptInline), $parameters, 'painless');

        $custom->setScript($script);

        return $custom;
    }

    /**
     * @return int|null
     */
    protected function getCustomerId()
    {
        $customer = $this->customerClient->getCustomer();

        return $customer ? $customer->getIdCustomer() : 27;
    }
}
