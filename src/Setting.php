<?php

namespace Italofantone\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function set($key, $value)
    {
        $validator = Validator::make([
            'key' => $key,
            'value' => $value
        ], [
            'key' => 'required|string',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

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