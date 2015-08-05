<?php

namespace TwigIntegratorKit\Assetic\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

class CoffeephpFilter implements FilterInterface
{
    public function filterLoad(AssetInterface $asset)
    {
        $content = $asset->getContent();
        $root    = $asset->getSourceRoot();
        $path    = $asset->getSourcePath();

        if (! empty($content)) {
            $content = \CoffeeScript\Compiler::compile($asset->getContent(), array(
                'filename' => $path,
            ));
        }

        $asset->setContent($content);
    }

    public function filterDump(AssetInterface $asset)
    {
    }
}
