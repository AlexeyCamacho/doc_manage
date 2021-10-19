<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function search_children_for_key($searchKey, $arr, $childrenCategories) {
        $result = [];

        foreach ($arr as $item) {

            if (isset($item[$searchKey])) {
                $result[] = $item[$searchKey];
            }

            if (isset($item[$childrenCategories])) {
                $result = array_merge($result, self::search_children_for_key($searchKey, $item[$childrenCategories], $childrenCategories));
            }
        }

        return $result;
    }
}
