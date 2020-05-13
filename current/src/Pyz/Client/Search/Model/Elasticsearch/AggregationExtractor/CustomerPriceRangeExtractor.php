<?php


namespace Pyz\Client\Search\Model\Elasticsearch\AggregationExtractor;


use Spryker\Client\Search\Model\Elasticsearch\AggregationExtractor\PriceRangeExtractor;

class CustomerPriceRangeExtractor extends PriceRangeExtractor
{
    protected function extractRangeData(array $aggregation)
    {
        if (!empty($aggregation)) {
            return [
                $aggregation['min'],
                $aggregation['max'],
            ];
        }

        return [null, null];
    }
}
