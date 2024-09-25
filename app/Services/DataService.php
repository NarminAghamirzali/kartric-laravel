<?php

namespace App\Services;

use Illuminate\Support\Str;

class DataService
{

    public function sluggable($str)
    {
      return Str::slug($str);
    }

    public function sluggableArray($array, $keyArr)
    {
        $slugs = [];
        foreach ($array[$keyArr] as $key => $value) {
            $slugs[$key] = $this->sluggable($value);
        }
        return $slugs;
    }

    public function search($model, $name, $q)
    {
        $locale = app()->getLocale();
        if ($q) {
            $categories = $model::where($name . '->' . $locale, $q)->paginate(10);
        } else {
            $categories = $model::paginate(10);
        }
        return $categories;
    }

    public function getNowDateStr()
    {
        list($microseconds, $seconds) = explode(' ', microtime());
        $milliseconds = sprintf('%03d', $microseconds * 1000);
        $datetime = date('YmdHis', $seconds);

        $post_data = $datetime . $milliseconds;
        return $post_data;
    }
}