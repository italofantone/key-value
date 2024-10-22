<?php

namespace Italofantone\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public function get(string $key)
    {
        return $this->where('key', $key)->value('value');
    }

    public function set(string $key, mixed $value): self
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

    protected function updateOrCreateSetting(string $key, mixed $value): self
    {
        return $this->updateOrCreate([
            'key' => strtolower($key)
        ], [
            'value' => $value
        ]);
    }
}