<?php

namespace App\CacheWarmer;

use App\Entity\Model;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Mapping\Loader\LoaderChain;
use Symfony\Component\Validator\ValidatorBuilder;

#[AutoconfigureTag('kernel.cache_warmer')]
class TriggerLazyClassMetadata implements CacheWarmerInterface
{
    public function warmUp(string $cacheDir, ?string $buildDir = null): array
    {
        $metadataFactory = new LazyLoadingMetadataFactory(
            new LoaderChain([new AttributeLoader]),
            $adapter = new PhpFilesAdapter(
                directory: '/Users/oandreyev/Development/symfony_issue_57641/var/cache'
            )
        );
        $metadataFactory->getMetadataFor(Model::class);
        $adapter->commit();
        return [];
    }

    public function isOptional(): bool
    {
        return false;
    }
}