<?php

namespace Italofantone\Setting\Tests;

use Illuminate\Validation\ValidationException;
use Italofantone\Setting\Facades\Setting as SettingFacade;

class SettingTest extends TestCase
{
    public function test_it_can_set_a_key_in_lowercase()
    {
        SettingFacade::set('TiTlE', 'My APP');

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => 'My APP'
        ]);
    }

    public function test_it_can_update_a_key()
    {
        SettingFacade::set('TiTlE', 'My APP');
        SettingFacade::set('title', 'New APP');

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => 'New APP'
        ]);
    }

    public function test_it_throws_an_exception_when_key_or_value_is_empty()
    {
        $this->expectException(ValidationException::class);
        SettingFacade::set('', 'value');

        $this->expectException(ValidationException::class);
        SettingFacade::set('key', '');
    }
}