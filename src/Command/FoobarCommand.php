<?php

namespace App\Command;

use App\Entity\Model;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Mapping\Loader\LoaderChain;

#[AsCommand('app:foobar')]
class FoobarCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $metadataFactory = new LazyLoadingMetadataFactory(
            new LoaderChain([new AttributeLoader]),
            $adapter = new PhpFilesAdapter(
                directory: '/Users/oandreyev/Development/symfony_issue_57641/var/cache'
            )
        );
        $metadata = $metadataFactory->getMetadataFor(Model::class);
        dump($metadata);

        return 0;
    }
}