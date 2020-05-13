<?php


namespace Pyz\Client\Search\Model\Elasticsearch\Query;


use Elastica\Aggregation\Stats;
use Elastica\Script\Script;
use Generated\Shared\Transfer\FacetConfigTransfer;

class CustomerPriceRangeQuery
{

    public function __construct(FacetConfigTransfer $facetConfigTransfer, $filterValue, $customerClient)
    {
        $this->facetConfig = $facetConfigTransfer;
        $this->customerClient = $customerClient;
    }
    
    public function getQuery()
    {
        $custom = new Stats('customer-price');
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
    
}