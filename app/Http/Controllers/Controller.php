<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests,DispatchesJobs;

    protected function isIncludeFields($request, $fields_string)
    {
        $fields_array = explode(",", $fields_string);
        $field_and_rule = array();
        foreach ($fields_array as $field) {
            $field_and_rule[$field] = "required";
        }
        return Validator::make($request->all(), $field_and_rule);
    }
}
