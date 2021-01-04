<?php

namespace App\Services\Friendship;

use App\Models\Member;
use App\Repositories\Database\BaseRespository;
use App\Repositories\Database\Interfaces\IFriendshipRepository;
use App\Repositories\Database\Interfaces\IMemberRepository;
use Exception;

/**
 * Class CreateService
 * @package App\Services\Friendship
 * Service creates a friendship in system
 */
class CreateService
{
    private bool $created = false;

    private IFriendshipRepository $friendshipRepository;
    private IMemberRepository $memberRepository;

    public function __construct(
        IFriendshipRepository $friendshipRepository,
        IMemberRepository $memberRepository
    ) {
        $this->friendshipRepository = $friendshipRepository;
        $this->memberRepository = $memberRepository;
    }

    public function __invoke($memberId, $friendId) : bool
    {
        $this->created = false;
        try {
            BaseRespository::beginTransaction();
            
            // check If member exists
            if ($this->memberRepository->exists($memberId)) {
                if ($this->memberRepository->exists($friendId)) {
                    $friendship = $this->friendshipRepository->create($memberId, $friendId);
                    $this->created = true;
                    BaseRespository::commit();
                    return true;
                } else {
                    throw new Exception('Input friendId does not exist.', 102);
                }
            } else {
                throw new Exception('Input memberId does not exist.', 103);
            }
        } catch (Exception $e) {
            BaseRespository::rollback();
            throw $e;
        }
    }
}
