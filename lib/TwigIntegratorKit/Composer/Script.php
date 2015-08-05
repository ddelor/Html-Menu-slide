<?php

namespace TwigIntegratorKit\Composer;

use Composer\Script\Event;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Script
{
    protected static $io;

    public static function install($event=null)
    {
        if ($event instanceof Event) {
            self::$io = $event->getIO();
        }

        $dir = realpath(__DIR__ . '/../../../');

        $filesystem = new Filesystem();
        $finder     = new Finder();

        self::chmod($dir . '/web/css', 0777);
        self::chmod($dir . '/web/js', 0777);
        self::chmod($dir . '/app/cache', 0777);

        self::write('<info>Update twig-integrator web/* chmod</info>');

        self::symlink($dir . '/integration/public', $dir . '/web/assets');

        $finder->directories()
            ->depth('== 0')
            ->in($dir . '/integration/public')
            ->exclude('css')
            ->exclude('js')
        ;

        foreach ($finder as $file) {
            self::symlink($file->getRealpath(), $dir . '/web/' . $file->getRelativePathname());
        }

        self::write('<info>Generate twig-integrator symlinks</info>');
    }

    protected static function chmod($dir, $mode)
    {
        $filesystem = new Filesystem();

        try {
            $filesystem->chmod($dir, $mode);
        }
        catch (\Exception $e) {}
    }

    protected static function symlink($origin, $target)
    {
        $filesystem = new Filesystem();

        try {
            $filesystem->symlink($origin, $target);
        }
        catch (\Exception $e) {}
    }

    protected static function write($string)
    {
        if (self::$io === null) {
            return;
        }

        self::$io->write($string);
    }
}
