<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new filter.';

    /**
     * Execute the console command.
     */
    public function handle()
    {                
        $classTemplatePath = __DIR__.'/Templates/CreateFilterTemplate.php';

        if(!file_exists($classTemplatePath)) {                    
            return $this->error('Error: Filter template not defined.');
        }        
        try {    
            $className = $this->argument("name");
            $classPath = str_replace('Console/Commands', "Http/Filters/$className.php", __DIR__);
            $classTemplate = file_get_contents($classTemplatePath);            
            $classTemplate = str_replace('Name', $className, $classTemplate);

            file_put_contents($classPath, $classTemplate);
            $this->info("Filter $className created successfully.");
        }catch(\Exception $e) {
            $this->error("Error: {$e->getMessage()}");
        }
    }
}
