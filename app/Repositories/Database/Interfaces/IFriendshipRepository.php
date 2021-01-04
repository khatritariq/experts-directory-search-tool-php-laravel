<?php

namespace App\Repositories\Database\Interfaces;

use App\Models\Friendship;
use App\Models\Member;

/**
 * Interface IFriendshipRepository
 * @package App\Repositories\Database\Interfaces
 * @codeCoverageIgnore
 */
interface IFriendshipRepository
{
    /**
     * @return Friendship
     */
    public function create(int $memberId, int $friendId) : bool;
}
