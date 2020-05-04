<?php


namespace Pyz\Zed\PriceImport\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @method \Pyz\Zed\PriceImport\Business\PriceImportFacade getFacade()
 */
class PriceImportCommand extends Console
{

    protected static $NAME = 'training:price-import';

    protected function configure()
    {
        parent::configure();
        $this->setName(self::$NAME);
        $this->addArgument('path', InputArgument::REQUIRED);
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $this->getFacade()->runImport($path);

        return self::CODE_SUCCESS;
    }
}
