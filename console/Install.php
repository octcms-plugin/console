<?php namespace Octcms\Console\Console;

use Cms\Classes\ThemeManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Schema\Blueprint;
use System\Classes\PluginManager;
use System\Classes\UpdateManager;

class Install extends BaseInstaller
{
    /**
     * @var string The console command name.
     */
    protected $name = 'octcms:install';

    /**
     * @var string The console command description.
     */
    protected $description = 'OctCMS安装...';


    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->output->writeln('<info>OctCMS开始安装... </info>');

//        $this->call('october:up'); //初始化数据库

        $pluginManager = PluginManager::instance();
        // 安装插件
        foreach (parent::$pluginsInstall as $plugin){
            $pluginName = $pluginManager->normalizeIdentifier($plugin);
            if (!$pluginManager->hasPlugin($pluginName)) {
                $this->call('plugin:install', ['name' => $pluginName]);
//                Artisan::call('plugin:install', ['name' => $plugin]); //另一种执行
            }
        }

        //安装默认主题
//        $themeManager = ThemeManager::instance();
//        $themeManager->setInstalled('octcms-blog');
//        if(DB::table('system_parameters')->where([['namespace','=','cms'],['group','=','theme']])->count() == 0) {
//            $this->call('theme:use', ['name' => 'octcms-blog']); //设置默认主题
//        }

        $this->output->writeln('<info>OctCMS安装完成!</info>');
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
