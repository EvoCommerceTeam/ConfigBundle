<?php

namespace Evo\Platform\ConfigBundle\Config\DataSource;

abstract class ImmutableConfigDataSource implements ConfigDataSource
{
    public function set($key, $value){}
}