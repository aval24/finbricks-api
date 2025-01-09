<?php

namespace Api\Config;

class Config
{
    private array $config;

    /**
     * @param string $configPath
     */
    public function __construct(string $configPath)
    {
        $this->config = require $configPath;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->config[$key];
    }
}
