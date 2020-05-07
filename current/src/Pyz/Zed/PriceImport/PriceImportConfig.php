<?php


namespace Pyz\Zed\PriceImport;


use Spryker\Zed\Kernel\AbstractBundleConfig;

class PriceImportConfig extends AbstractBundleConfig
{

    public const STORAGE_QUEUE = 'sync.storage.price_import';
    public const STORAGE_ERROR_QUEUE = 'sync.storage.price_import.error';

}