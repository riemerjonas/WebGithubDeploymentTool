<?php

namespace WebGDTool\Utilities;
class Configuration
{
    private array $config = [];
    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * Get the configuration array.
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Load configuration from a JSON file.
     * @throws \Exception
     * @return void
     */
    private function loadConfig()
    {
        $directory = dirname(__DIR__, 2) . '/config';
        $filename = "_config.json";
        $filePath = $directory . '/' . $filename;

        if(!file_exists($filePath)) 
        {
            throw new \Exception("Configuration file not found: " . $filePath);
        }

        $jsonContent = file_get_contents($filePath);
        if ($jsonContent === false) 
        {
            throw new \Exception("Failed to read configuration file: " . $filePath);
        }

        $this->config = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) 
        {
            throw new \Exception("Invalid JSON in configuration file: " . $filePath . " - " . json_last_error_msg());
        }

        if (!is_array($this->config)) 
        {
            throw new \Exception("Configuration file does not contain a valid JSON object: " . $filePath);
        }

        if (array_values($this->config) === $this->config) 
        {
            throw new \Exception("Configuration file must be an associative array: " . $filePath);
        }

        $this->config = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $this->config);
    }
}


?>