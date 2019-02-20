<?php namespace Octcms\Console\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

abstract class BaseInstaller extends Command
{
    protected static $pluginsInstall = [
        'RainLab.Translate',
        'RainLab.User',
        'RainLab.Blog',
        'RainLab.Pages',
        'PolloZen.NextPrevPost',
        'GinoPane.BlogTaxonomy',
        'PKleindienst.BlogSearch',
        'PolloZen.MostVisited',
        'SaurabhDhariwal.Comments',
        'Benfreke.Menumanager',
        'Indikator.Paste',
        'Vaslv.Carousel',
        'LynxSolutions.Scrolltop',
        'VojtaSvoboda.TwigExtensions',
    ];

    protected static $pluginsUninstall = [
        'RainLab.Translate',
        'RainLab.User',
        'Benfreke.Menumanager',
        'Indikator.Paste',
        'Vaslv.Carousel',
        'LynxSolutions.Scrolltop',
        'VojtaSvoboda.TwigExtensions',
        'PolloZen.NextPrevPost',
        'GinoPane.BlogTaxonomy',
        'PKleindienst.BlogSearch',
        'PolloZen.MostVisited',
        'SaurabhDhariwal.Comments',
        'RainLab.Pages',
        'RainLab.Blog',
    ];

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
