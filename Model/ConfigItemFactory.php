<?php

namespace Evo\Platform\ConfigBundle\Model;


use Evo\Platform\ConfigBundle\Entity\ConfigItem;

class ConfigItemFactory
{
    public static function createConfigItem($configKey, $value, $applicationId)
    {
        list($group, $key) = explode(ConfigItem::TOKEN_SEPARATOR, $configKey);

        return new ConfigItem($group, $key, $value, $applicationId);
    }
}