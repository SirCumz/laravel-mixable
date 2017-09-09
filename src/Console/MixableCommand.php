<?php

namespace SirCumz\LaravelMixable\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MixableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mixable:manifest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a manifest of mixable paths';

    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $paths = [];

        foreach ($this->files->directories( app_path('Modules') ) as $dir) {
            if($this->files->exists($dir . '/mix.js')) {
                $paths[] = $dir . '/mix.js'; 
            }         
        }

        $this->files->put( dirname(dirname(dirname(__FILE__))) . '/mixable-manifest.js', 'module.exports = ' . json_encode($paths));

        $this->info('Mixable manifest created successfully.');
    }
}