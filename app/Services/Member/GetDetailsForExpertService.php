<?php

namespace App\Services\Member;

use App\Repositories\Database\Interfaces\IMemberRepository;
use Exception;

/**
 * Class GetDetailsForExpertService
 * @package App\Services\Member
 * Gets a member with details for expert topic
 */
class GetDetailsForExpertService
{

    private IMemberRepository $memberRepository;

    public function __construct(
        IMemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke($id, $topic) : array
    {
        try {
            $memberData = $this->memberRepository->getMemberWithTopicExpert($id, $topic);
            
            return $memberData;
        } catch (Exception $e) {
            throw $e;
        }
    }
}