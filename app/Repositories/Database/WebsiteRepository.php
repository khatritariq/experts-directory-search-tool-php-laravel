<?php

namespace App\Repositories\Database;

use App\Models\Website;
use App\Repositories\Database\Interfaces\IWebsiteRepository;

/**
 * Class WebsiteRepository
 * @package App\Domain\Repositories\Database
 * @codeCoverageIgnore
 */

class WebsiteRepository extends BaseRespository implements IWebsiteRepository
{
 
    /**
     * @var string
     */
    protected $modelClass = Website::class;

    public function create($model) : bool
    {
        return $model->save();
    }
}
