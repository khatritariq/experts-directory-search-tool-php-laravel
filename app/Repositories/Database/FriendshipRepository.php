<?php

namespace App\Repositories\Database;

use App\Models\Friendship;
use App\Models\Member;
use App\Repositories\Database\Interfaces\IFriendshipRepository;

/**
 * Class FriendshipRepository
 * @package App\Domain\Repositories\Database
 * @codeCoverageIgnore
 */

class FriendshipRepository extends BaseRespository implements IFriendshipRepository
{
 
    /**
     * @var string
     */
    protected $modelClass = Friendship::class;

    public function create(int $memberId, int $friendId) : bool
    {
        $friendship = new Friendship();
        $friendship->member_id = $memberId;
        $friendship->friend_id = $friendId;
        $friendship->save();

        $friendshipReciprocal = new Friendship();
        $friendshipReciprocal->member_id = $friendId;
        $friendshipReciprocal->friend_id = $memberId;
        return $friendshipReciprocal->save();
    }
}
