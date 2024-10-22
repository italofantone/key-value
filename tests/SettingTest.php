<?php

namespace Italofantone\Setting\Tests;

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
}