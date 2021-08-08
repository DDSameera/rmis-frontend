<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\ConsoleOutput;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rmis:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'InstallCommand RMIS Frontend';

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
     * @return int
     */
    public function handle()
    {

        //Welcome
        $this->info('******** Welcome to the RMIS Command line Installation Wizard ********');

        //1.Optimize
        $this->info('******** Optimization Process [1/8] *******');
        $this->optimize();

        //2. Clone ENV File
        $this->info('******** ENV File Cloned  [2/8] *******');
        $this->cloneEnvFile();


        //3.SETUP API BASE URL
        $this->info('******** SETUP BACKEND API DOMAIN  [3/8] *******');
        $this->setAPIDomain();


        //4. Setup Environment
        $this->info('******** App Environment [4/8] *******');
        $this->setupAppEnvironment();


        //5. APP Key Generate
        $this->info('******** Secure App Key Generated [5/8]*******');
        $this->appKeyGenerate();


        //6.Run Composer Commands
        $this->info('******** Composer Command Run [6/8]*******');
        $this->runComposerCommands();


        //7.Optimize
        $this->info('******** Optimization Process [7/8] *******');
        $this->optimize();

        //8.Run Server
        $this->info('******** All Process Completed [8/8] .Server is running *******');
        $this->runServer();

    }

    public function setAPIDomain(): bool
    {

        if ($this->confirm('Do you like to Change Default Backend API Base Url ? ', false)) {
            $apiDomain = $this->ask('Enter Backend API Base Url ');
            $this->modifyEnvFile('API_DOMAIN=' . env('API_DOMAIN'), 'API_DOMAIN=' . $apiDomain);
        } else {
            $apiDomain = 'http://127.0.0.1:8000';
            $this->modifyEnvFile('API_DOMAIN=' . env('API_DOMAIN'), 'API_DOMAIN=' . $apiDomain);
        }

        return true;
    }

    public function runComposerCommands(): bool
    {

        shell_exec('composer install');
        return true;
    }

    public function runServer(): bool
    {

        $output = new ConsoleOutput;
        $serverIp = config('app.url');
        $serverPort = config('app.port');

        $output->writeln("RMIS Frontend APP Server Started. Please COPY this IP & Paste it on Web Browser (Recommended : Chrome) <$serverIp:$serverPort>");

        Artisan::call('serve', ['--port' => $serverPort]);
        Artisan::output();

        return true;
    }


    public function cloneEnvFile(): bool
    {


        if (!file_exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
            $this->optimize();
            return true;
        }

        return false;
    }


    public function setupAppEnvironment(): bool
    {
        $environmentInput = $this->choice(
            'Choose your Application environment?',
            ['production', 'local'],
            'local'
        );

        $this->modifyEnvFile('API_ENV=' . env('API_ENV'), 'API_ENV=' . $environmentInput);
        return true;
    }


    public function modifyEnvFile($searchStr, $replaceStr): bool
    {

        $path = base_path('.env');

        if (file_exists($path)) {
            $replace = file_put_contents($path, str_replace(
                $searchStr, $replaceStr, file_get_contents($path)
            ));
            if (!$replace) {
                return false;
            }

        }

        return true;
    }

    public function optimize(): bool
    {

        Artisan::call('config:cache');
        echo Artisan::output();

        Artisan::call('config:clear');
        echo Artisan::output();

        Artisan::call('optimize');
        echo Artisan::output();

        Artisan::call('route:clear');
        echo Artisan::output();

        Artisan::call('route:cache');
        echo Artisan::output();

        return true;

    }

    public function appKeyGenerate(): bool
    {

        Artisan::call('key:generate', ['--force' => true]);
        echo Artisan::output();

        return true;
    }
}
