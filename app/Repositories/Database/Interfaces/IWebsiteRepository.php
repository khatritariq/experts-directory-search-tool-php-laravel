<?php

namespace App\Repositories\Database\Interfaces;

use App\Models\Website;

/**
 * Interface IWebsiteRepository
 * @package App\Repositories\Database\Interfaces
 * @codeCoverageIgnore
 */
interface IWebsiteRepository
{
    /**
     * @return bool
     */
    public function create(Website $model) : bool;
}
