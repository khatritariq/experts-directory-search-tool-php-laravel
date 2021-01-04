<?php

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;

/**
 * Class BaseRespository
 * @package App\Domain\Repositories\Database
 * @codeCoverageIgnore
 */

class BaseRespository
{
 
    public static function beginTransaction()
    {
        DB::beginTransaction();
    }

    public static function commit()
    {
        DB::commit();
    }

    public static function rollback()
    {
        DB::rollBack();
    }
}
