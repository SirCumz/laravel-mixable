<?php

namespace SirCumz\LaravelMixable\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ManifestCommand extends Command
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
     * @param  Filesystem  $files
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
        $this->laravel['mixable']->export();

        $this->info('Mixable manifest created successfully.');
    }
}