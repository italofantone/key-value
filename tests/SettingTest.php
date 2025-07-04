<?php

namespace Italofantone\Setting\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Italofantone\Setting\Facades\Setting as SettingFacade;

class SettingTest extends TestCase
{
    public function test_it_can_set_a_key_in_lowercase(): void
    {
        SettingFacade::set('TiTlE', 'My APP');

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => 'My APP'
        ]);
    }

    public function test_it_can_set_a_null_value(): void
    {
        SettingFacade::set('title', null);

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => null
        ]);
    }

    public function test_it_can_update_a_key(): void
    {
        SettingFacade::set('TiTlE', 'My APP');
        SettingFacade::set('title', 'New APP');

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => 'New APP'
        ]);
    }

    public function test_it_throws_an_exception_when_key_is_empty(): void
    {
        $this->expectException(ValidationException::class);
        SettingFacade::set('', 'My APP');
    }

    public function test_it_can_get_a_setting_by_key(): void
    {
        DB::table('settings')->insert([
            'key' => 'title',
            'value' => 'My APP'
        ]);

        $value = SettingFacade::get('title');

        $this->assertEquals('My APP', $value);
    }

    public function test_get_returns_default_when_not_exists()
    {
        $setting = SettingFacade::get('no_existe', 'Valor por defecto');

        $this->assertEquals('Valor por defecto', $setting);
    }

    public function test_it_returns_null_when_key_does_not_exist(): void
    {
        $value = SettingFacade::get('title');

        $this->assertNull($value);
    }

    public function test_helper_can_get_a_setting_by_key(): void
    {
        DB::table('settings')->insert([
            'key' => 'title',
            'value' => 'My APP'
        ]);

        $this->assertDatabaseHas('settings', [
            'key' => 'title',
            'value' => 'My APP'
        ]);

        $value = setting('title');

        $this->assertEquals('My APP', $value);
    }

    public function test_it_can_get_a_setting_value_by_route(): void
    {
        $this->get('/v1/setting/title')
            ->assertStatus(200)
            ->assertJson([
                'title' => null
            ]);

        DB::table('settings')->insert([
            'key' => 'title',
            'value' => 'My APP'
        ]);
 
        $this->get('/v1/setting/title')
            ->assertStatus(200)
            ->assertJson([
                'title' => 'My APP'
            ]);
    }
}