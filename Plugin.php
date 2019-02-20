<?php namespace Octcms\Console;

use System\Classes\PluginBase;

/**
 * Class Plugin
 * @package Octcms\Console
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Console',
            'description' => 'OctCMS命令行',
            'author'      => 'Yikui Shi',
            'icon'        => 'icon-terminal'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('octcms:install', 'Octcms\Console\Console\Install');
        $this->registerConsoleCommand('octcms:uninstall', 'Octcms\Console\Console\Uninstall');
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->app->singleton('octcms:install', function() {
            return new \Octcms\Console\Console\Install;
        });
        $this->app->singleton('octcms:uninstall', function() {
            return new \Octcms\Console\Console\Uninstall;
        });

        $this->commands('octcms:install');
        $this->commands('octcms:uninstall');
    }

}
