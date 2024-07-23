<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class DocsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = base_path('docs/openapi.yaml');
        if(!file_exists($path)) {
            return $this->error('File openapi.yaml was not defined in /docs/');
        }
        $yamlContents = file_get_contents($path);
        $arrayData = Yaml::parse($yamlContents);        
        $jsonData = json_encode($arrayData);
        $apiDocsPath = storage_path('api-docs/api-docs.json');
        file_put_contents($apiDocsPath, $jsonData);
    }
}
