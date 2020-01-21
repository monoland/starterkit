<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait HasMeta
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $metas = [];

    /**
     * Undocumented function
     *
     * @param [type] $key
     * @return void
     */
    private function getMeta($key)
    {
        $metaFld = parent::getAttribute('meta');

        if (is_null($metaFld) || empty($metaFld) || !array_key_exists($key, $metaFld)) {
            return null;
        }

        return $metaFld[$key];
    }

    /**
     * Undocumented function
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    private function setMeta($key, $value)
    {
        if (empty($this->metas)) {
            $this->metas = parent::getAttribute('meta');
        }

        $this->metas[$key] = $value;
    }

    /**
     * Undocumented function
     *
     * @param [type] $key
     * @return void
     */
    public function getAttribute($key)
    {
        if (($attr = parent::getAttribute($key)) !== null) {
            return $attr;
        }

        return $this->getMeta($key);
    }

    /**
     * Undocumented function
     *
     * @param [type] $key
     * @param [type] $value
     */
    public function __set($key, $value)
    {
        if (array_key_exists($key, parent::getAttributes())) {
            parent::setAttribute($key, $value);

            return;
        }

        if (Schema::hasColumn($this->getTable(), $key)) {
            parent::setAttribute($key, $value);

            return;
        }

        return $this->setMeta($key, $value);
    }

    /**
     * Undocumented function
     *
     * @param array $options
     * @return void
     */
    public function save(array $options = [])
    {
        if (!empty($this->metas)) {
            parent::setAttribute('meta', $this->metas);
        }

        return parent::save($options);
    }
}
