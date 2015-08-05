<?php

namespace TwigIntegratorKit;

use Twig_Function_Method;
use Twig_Filter_Method;

class TwigExtension extends \Twig_Extension
{
    /** @var Application  $app  The application **/
    protected $app;

    /**
     *
     *
     * @param Container  $app  The application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
        );
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'asset' => new Twig_Function_Method($this, 'getAssetPath', array()),
            'path'  => new Twig_Function_Method($this, 'getPath', array()),
        );
    }

    public function getAssetPath($path) {
        return sprintf('%s/assets/%s',
            $this->app['request']->getBaseUrl(),
            ltrim($path, '/')
        );
    }

    public function getPath($path) {
        return sprintf('%s/%s',
            $this->app['request']->getBaseUrl(),
            ltrim($path, '/')
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'twig_integrator_kit';
    }
}
