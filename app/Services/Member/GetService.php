<?php

namespace App\Services\Member;

use App\Repositories\Database\Interfaces\IMemberRepository;
use Exception;

/**
 * Class GetService
 * @package App\Services\Member
 * Gets a member from the system
 */
class GetService
{

    private IMemberRepository $memberRepository;

    public function __construct(
        IMemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke($id) : array
    {
        try {
            $memberData = $this->memberRepository->get($id);
            foreach ($memberData as $k => $value) {
                if ($k == 'websiteHeadings') {
                    if (isset($value)) {
                        $headings = explode(',', $value);
                        $memberData[$k] = $headings;
                    } else {
                        $memberData[$k] = [];
                    }
                }
                if ($k == 'friendsIds') {
                    if (isset($value)) {
                        $friendsIds = explode(',', $value);
                        unset($memberData[$k]);
                        foreach ($friendsIds as $k1 => $id) {
                            $memberData['friends'][$k1] = 'http://localhost:8000/api/member/'.$id ;
                        }
                    } else {
                        unset($memberData[$k]);
                        $memberData['friends'] = [];
                    }
                }
            }
            return $memberData;
        } catch (Exception $e) {
            dd($e);
            throw $e;
        }
    }
}