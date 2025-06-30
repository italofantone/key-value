<?php

namespace Italofantone\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->where('key', $key)->value('value');

        return $value !== null ? $value : $default;
    }

    public function set(string $key, mixed $value = null): self
    {
        $validator = Validator::make([
            'key' => $key
        ], [
            'key' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->updateOrCreateSetting($key, $value);
    }

    protected function updateOrCreateSetting(string $key, mixed $value = null): self
    {
        return $this->updateOrCreate([
            'key' => strtolower($key)
        ], [
            'value' => $value
        ]);
    }
}