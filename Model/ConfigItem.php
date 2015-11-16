<?php

namespace Evo\Platform\ConfigBundle\Model;


use Evo\Platform\DistributionBundle\Shared\ORM\TimestampableTrait;

class ConfigItem
{
    const TOKEN_SEPARATOR = '.';

    use TimestampableTrait;

    protected $id;
    protected $group;
    protected $key;
    protected $value;
    protected $valueType;
    protected $applicationId;

    public function __construct($group, $key, $value, $applicationId)
    {
        $this->group            = $group;
        $this->key              = $key;
        $this->value            = $this->processValue($value);
        $this->applicationId    = $applicationId;

        $this->createTimestamp();
    }

    public function update($value)
    {
        $this->value = $this->processValue($value);
        $this->updateTimestamp();
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function processValue($value)
    {
        if (!is_scalar($value) && !is_array($value)) {
            throw new \InvalidArgumentException("Value should be either scalar or array.");
        }

        if (is_array($value)) {
            $this->valueType = 'array';
            return serialize($value);
        }

        $this->valueType = 'scalar';
        return $value;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        if ('array' === $this->valueType ) {
            return unserialize($this->value);
        }

        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }
}