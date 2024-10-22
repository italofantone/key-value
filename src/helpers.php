<?php

if (! function_exists('setting')) {
    /**
     * Get the specified setting value.
     * 
     * @param string $key
     * @return mixed
     */
    function setting(string $key): mixed {
        return app('setting.manager')->get($key);
    }
}