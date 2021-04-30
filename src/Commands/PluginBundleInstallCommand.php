<?php


namespace rohsyl\OmegaPlugin\Bundle\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin;
use rohsyl\OmegaPlugin\Bundle\PluginRegistar;

class PluginBundleInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omega-plugins-bundle:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install omega-plugins-bundle plugins';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $plugins = PluginRegistar::getRegisteredPlugins();

        $this->info('Installing omega-plugins-bundle ('.sizeof($plugins).')');

        if(sizeof($plugins) == 0) {
            $this->error('Nothing to install');
            return 1;
        }

        $plugins = array_map(function($plugin) {
            return $plugin::NAME;
        }, $plugins);

        $plugins = join(' ', $plugins);

        $code = Artisan::call('omega:plugin-install ' . $plugins);

        $this->info(Artisan::output());

        $this->info('[ DONE ]');

        return $code;
    }
}