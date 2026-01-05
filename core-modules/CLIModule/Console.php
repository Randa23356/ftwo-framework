<?php

namespace CoreModules\CLIModule;

class Console
{
    private $args;
    private $colors = [
        'green' => "\033[32m",
        'blue' => "\033[34m",
        'yellow' => "\033[33m",
        'red' => "\033[31m",
        'reset' => "\033[0m"
    ];

    public function __construct($argv)
    {
        $this->args = $argv;
    }

    public function run()
    {
        $this->banner();

        if (!isset($this->args[1])) {
            $this->help();
            return;
        }

        $command = $this->args[1];
        
        switch ($command) {
            case 'craft:controller':
                $this->makeController($this->args[2] ?? null);
                break;
            case 'craft:model':
                $this->makeModel($this->args[2] ?? null);
                break;
            case 'craft:view':
                $this->makeView($this->args[2] ?? null);
                break;
            case 'craft:service':
                $this->makeService($this->args[2] ?? null);
                break;
            case 'ignite': // Creative rename for serve
            case 'serve':  // Keep strict alias
                $this->serve();
                break;
            default:
                echo "{$this->colors['red']}Unknown command: $command{$this->colors['reset']}\n";
                $this->help();
        }
    }

    private function banner()
    {
        echo $this->colors['blue'];
        echo "
    ___________               ________               
    \_   _____/___________  __\______ \   _______  __
     |    __)   \____ \_  \/ / |    |  \_/ __ \  \/ /
     |     \    |  |_> >    /  |    `   \  ___/\   / 
     \___  /    |   __/ \/\_/ /_______  /\___  >\_/  
         \/     |__|                  \/     \/      
        ";
        echo $this->colors['reset'] . "\n\n";
    }

    private function help()
    {
        echo "{$this->colors['yellow']}Usage:{$this->colors['reset']}\n";
        echo "  php ftwo ignite                Start the development server\n";
        echo "  php ftwo craft:controller Name Create a new controller\n";
        echo "  php ftwo craft:model Name      Create a new model\n";
        echo "  php ftwo craft:view Name       Create a new view\n";
        echo "  php ftwo craft:service Name    Create a new service\n";
    }

    private function serve()
    {
        $port = 8000;
        echo "{$this->colors['green']}🔥 FTwoDev engine currently running at http://localhost:$port{$this->colors['reset']}\n";
        echo "{$this->colors['yellow']}Press Ctrl+C to stop the engine.{$this->colors['reset']}\n";
        passthru("php -S localhost:$port -t " . __DIR__ . '/../../public');
    }

    private function makeController($name)
    {
        if (!$name) die("{$this->colors['red']}Error: Name required.{$this->colors['reset']}\n");
        $path = __DIR__ . '/../../projects/Controllers/' . $name . '.php';
        if (file_exists($path)) die("{$this->colors['red']}Error: Controller already exists.{$this->colors['reset']}\n");

        $template = "<?php\n\nnamespace Projects\\Controllers;\n\nuse Engine\\ControllerBase;\n\nclass $name extends ControllerBase\n{\n    public function index()\n    {\n        return \$this->view('welcome');\n    }\n}\n";
        
        file_put_contents($path, $template);
        echo "{$this->colors['green']}Controller $name crafted successfully.{$this->colors['reset']}\n";
    }

    private function makeModel($name)
    {
        if (!$name) die("{$this->colors['red']}Error: Name required.{$this->colors['reset']}\n");
        $path = __DIR__ . '/../../projects/Models/' . $name . '.php';
        if (file_exists($path)) die("{$this->colors['red']}Error: Model already exists.{$this->colors['reset']}\n");

        $template = "<?php\n\nnamespace Projects\\Models;\n\nuse Engine\\ModelBase;\n\nclass $name extends ModelBase\n{\n    protected \$table = '" . strtolower($name) . "s';\n}\n";
        
        file_put_contents($path, $template);
        echo "{$this->colors['green']}Model $name crafted successfully.{$this->colors['reset']}\n";
    }

    private function makeView($name)
    {
        if (!$name) die("{$this->colors['red']}Error: Name required.{$this->colors['reset']}\n");
        $path = __DIR__ . '/../../projects/Views/' . $name . '.ftwo.php';
        if (file_exists($path)) die("{$this->colors['red']}Error: View already exists.{$this->colors['reset']}\n");

        $template = "<h1>$name</h1>\n<p>Welcome to $name view.</p>";
        
        file_put_contents($path, $template);
        echo "{$this->colors['green']}View $name crafted successfully.{$this->colors['reset']}\n";
    }

    private function makeService($name)
    {
        if (!$name) die("{$this->colors['red']}Error: Name required.{$this->colors['reset']}\n");
        $path = __DIR__ . '/../../projects/Services/' . $name . '.php';
        
        // Ensure Services directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        if (file_exists($path)) die("{$this->colors['red']}Error: Service already exists.{$this->colors['reset']}\n");

        $template = "<?php\n\nnamespace Projects\\Services;\n\nclass $name\n{\n    public function execute()\n    {\n        // ...\n    }\n}\n";
        
        file_put_contents($path, $template);
        echo "{$this->colors['green']}Service $name crafted successfully.{$this->colors['reset']}\n";
    }
}
