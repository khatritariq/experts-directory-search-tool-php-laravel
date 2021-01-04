<?php

namespace App\Repositories\Database\Interfaces;

use App\Models\Member;
use Illuminate\Support\Collection;

/**
 * Interface IMemberRepository
 * @package App\Repositories\Database\Interfaces
 * @codeCoverageIgnore
 */
interface IMemberRepository
{
    /**
     * @return bool
     */
    public function create(Member $model) : bool;
    public function exists(int $memberId) : bool;
    public function getAll() : array;
    public function get(int $id) : array;
    public function getMemberWithTopicExpert(int $id, string $topic) : array;
}
