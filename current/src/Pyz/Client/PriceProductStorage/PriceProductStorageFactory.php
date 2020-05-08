<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\PriceProductStorage;

use Pyz\Client\PriceProductStorage\Storage\PriceAbstractStorageReader;
use Spryker\Client\PriceProductStorage\PriceProductStorageFactory as SprykerPriceProductStorageFactory;

class PriceProductStorageFactory extends SprykerPriceProductStorageFactory
{
    public function __createPriceAbstractStorageReader()
    {
        $parentReader = parent::createPriceAbstractStorageReader();
        $client = $this->getPriceImportClient();

        return new PriceAbstractStorageReader($parentReader, $client);
    }

    protected function getPriceImportClient()
    {
        return $this->getProvidedDependency(PriceProductStorageDependencyProvider::PRICE_IMPORT_CLIENT);
    }
}
