<?php

namespace App\Services\Member;

use App\Repositories\Database\Interfaces\IMemberRepository;
use Exception;

/**
 * Class GetAllService
 * @package App\Services\Member
 * Gets all members in system
 */
class GetAllService
{

    private IMemberRepository $memberRepository;

    public function __construct(
        IMemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke() : array
    {
        try {
            return $this->memberRepository->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }
}