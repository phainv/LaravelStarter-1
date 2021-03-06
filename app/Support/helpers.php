<?php

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;

if (! function_exists('array_key_by')) {
    /**
     * Replace root array key with child array key.
     * Note that the specified key must exist in the query result, or it will be ignored.
     *
     * @param  array $data
     * @param  string $key
     * @return array
     */
    function array_key_by(array $data, $key)
    {
        $output = [];

        foreach ($data as $k => $value) {
            $output[(isset($value[$key])) ? $value[$key] : $k] = $value;
        }

        return $output;
    }
}

if (! function_exists('datetime')) {
    /**
     * Parse datetime with Carbon.
     *
     * @param  mixed $time
     * @param  string $timezone
     * @param  bool $reverse
     * @return \Carbon\Carbon
     */
    function datetime($time = null, $timezone = null, $reverse = false)
    {
        $timezone = in_array($timezone, timezone_identifiers_list()) ? $timezone : null;

        if (is_array($time)) {
            list($time, $format) = $time;
            $datetime = Carbon::createFromFormat($format, $time, $timezone);
        } else {
            $datetime = Carbon::parse($time, $timezone);
        }

        return $reverse ? $datetime->tz(config('app.timezone', 'UTC')) : $datetime;
    }
}

if (! function_exists('prd')) {
    /**
     * Print the passed variables and end the script.
     *
     * @param  mixed $x
     * @return void
     */
    function prd()
    {
        array_map(function ($x) {
            echo '<pre>';
            print_r($x);
            echo '</pre>';
        }, func_get_args());
        die;
    }
}

if (! function_exists('vd')) {
    /**
     * Dump the passed variables using var_dump and end the script.
     *
     * @param  mixed $x
     * @return void
     */
    function vd()
    {
        array_map(function ($x) {
            var_dump($x);
            die;
        }, func_get_args());
    }
}

if (! function_exists('random_filename')) {
    /**
     * Generate random filename.
     *
     * @param  mixed $file
     * @param  int $length
     * @param  Closure|null
     * @return string
     */
    function random_filename($file, $length = 20, Closure $closure = null)
    {
        if ($file instanceof UploadedFile) {
            $extension = $file->getClientOriginalExtension();
        } else {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
        }

        $name = str_random($length);

        if ($closure) {
            $name = $closure($name);
        }

        return $name.'.'.$extension;
    }
}

if (! function_exists('page_title')) {
    /**
     * Set the page title.
     *
     * @param  string $title
     * @param  string $delimiter
     * @param  string|null $defaultTitle
     * @return string
     */
    function page_title($title, $delimiter = '|', $defaultTitle = null)
    {
        $defaultTitle = $defaultTitle ?: config('app.name');

        if (! $title || $title == $defaultTitle) {
            return $defaultTitle;
        }

        return $title.' '.$delimiter.' '.$defaultTitle;
    }
}

if (! function_exists('active_route')) {
    /**
     * Return the "active" class if current route is matched.
     *
     * @param  string|array $route
     * @param  string $output
     * @return string|null
     */
    function active_route($route, $output = 'active')
    {
        if (is_array($route)) {
            if (call_user_func_array('Route::is', $route)) {
                return $output;
            }
        } else {
            if (Route::is($route)) {
                return $output;
            }
        }
    }
}
