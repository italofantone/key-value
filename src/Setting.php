<?php

namespace Italofantone\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function set($key, $value)
    {
        return $this->updateOrCreateSetting($key, $value);
    }

    protected function updateOrCreateSetting($key, $value)
    {
        return $this->updateOrCreate([
            'key' => strtolower($key)
        ], [
            'value' => $value
        ]);
    }
}