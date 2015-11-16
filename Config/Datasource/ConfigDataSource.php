<?php

namespace Evo\Platform\ConfigBundle\Config\DataSource;


interface ConfigDataSource
{
    public function get($key);
    public function set($key, $value);
    public function isReady();
    public function getType();
    public function getName();
    public function isPublic();
}