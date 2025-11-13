<?php

namespace App\Datatable;

use App\Models\App;

class AppDatatable
{
    public function get($input = [])
    {
        /** @var App $query */
        $query = App::query()->select('apps.*');

        return $query;
    }
}
