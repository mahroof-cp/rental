<?php

namespace App\Repositories\Settings;

interface SettingsRepositoryInterface
{

    public function getAll();

    public function settingsIn($keys);

    public function getByKey($key);

    public function getByKeys($keys);

    public function autoLoad();

    public function update(array $input);

    public function resetValue($setting);

    public function setValueAsArray($setting, $data);

    public function getKeyValue();
}