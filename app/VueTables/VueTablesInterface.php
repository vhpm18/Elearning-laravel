<?php

namespace App\VueTables;

interface VueTablesInterface
{

    public function get($model, array $fields, array $relations = []);

}
