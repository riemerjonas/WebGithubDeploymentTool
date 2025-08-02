<?php

namespace DeploymentTool\Utilities;
class Configuration
{
    private array $config = [];

    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * Method to get a configuration value by key.
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * Method for loading the configuration from a JSON file.
     * @throws \Exception
     * @return void
     */
    private function loadConfig() : void
    {
        $file = __DIR__ . '/../../config.json';
        if(file_exists($file)) 
        {
            $json = file_get_contents($file);
            if ($json !== false) 
            {
                $this->config = json_decode($json, true);
                if (json_last_error() !== JSON_ERROR_NONE) 
                {
                    throw new \Exception('Invalid JSON in configuration file: ' . json_last_error_msg());
                }
            }
            else 
            {
                throw new \Exception('Could not read configuration file: ' . $file);
            }
        } 
        else 
        {
            throw new \Exception('Configuration file does not exist: ' . $file);
        }
    }
}

?>