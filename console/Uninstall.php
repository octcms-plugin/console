<?php namespace Octcms\Console\Console;

use File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use System\Classes\PluginManager;
use System\Classes\UpdateManager;
use Symfony\Component\Console\Input\InputOption;
use Artisan;

class Uninstall extends BaseInstaller
{
    use \Illuminate\Console\ConfirmableTrait;
    /**
     * @var string The console command name.
     */
    protected $name = 'octcms:uninstall';

    /**
     * @var string The console command description.
     */
    protected $description = 'OctCMS卸载...';


    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        if (!$this->confirmToProceed('这个动作会删除所有数据和插件')) {
            return;
        }

        $this->output->writeln('<info>OctCMS开始卸载... </info>');

        $pluginManager = PluginManager::instance();
        // 删除插件
        foreach (parent::$pluginsUninstall as $plugin){
            $pluginName = $pluginManager->normalizeIdentifier($plugin);
            if ($pluginManager->hasPlugin($pluginName)) {
                if ($pluginPath = $pluginManager->getPluginPath($pluginName)) {
                    $this->call('plugin:remove', ['name' => $plugin, '--force' => true]);
//                    File::deleteDirectory($pluginPath);
                    $this->output->writeln(sprintf('<info>Deleted: %s</info>', $pluginName));
                }
            }
        }

        $this->output->writeln('<info>OctCMS卸载完成!</info>');
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
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run.'],
        ];
    }

    /**
     * Get the default confirmation callback.
     * @return \Closure
     */
    protected function getDefaultConfirmCallback()
    {
        return function () {
            return true;
        };
    }

    /**
     * Confirm before proceeding with the action.
     *
     * This method only asks for confirmation in production.
     *
     * @param  string  $warning
     * @param  \Closure|bool|null  $callback
     * @return bool
     */
    public function confirmToProceed($warning = 'Application In Production!', $callback = null)
    {
        $callback = is_null($callback) ? $this->getDefaultConfirmCallback() : $callback;

        $shouldConfirm = $callback instanceof Closure ? call_user_func($callback) : $callback;

        if ($shouldConfirm) {
            if ($this->option('force')) {
                return true;
            }

            $this->alert($warning);

            $confirmed = $this->confirm('真的要执行此命令吗?');

            if (! $confirmed) {
                $this->comment('命令已取消!');

                return false;
            }
        }

        return true;
    }
}
