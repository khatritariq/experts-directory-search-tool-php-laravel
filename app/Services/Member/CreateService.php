<?php

namespace App\Services\Member;

use App\Models\Member;
use App\Models\Website;
use App\Repositories\Database\BaseRespository;
use App\Repositories\Database\Interfaces\IMemberRepository;
use App\Repositories\Database\Interfaces\IWebsiteRepository;
use Exception;

/**
 * Class CreateService
 * @package App\Services\Member
 * Service creates a member in system
 */
class CreateService
{
    private bool $created = false;

    private IMemberRepository $memberRepository;
    private IWebsiteRepository $websiteRepository;

    public function __construct(
        IMemberRepository $memberRepository,
        IWebsiteRepository $websiteRepository
    ) {
        $this->memberRepository = $memberRepository;
        $this->websiteRepository = $websiteRepository;
    }

    public function __invoke($name, $websiteUrl) : int
    {
        try {
            BaseRespository::beginTransaction();
            $member = new Member();
            $member->name = $name;
            if ($this->memberRepository->create($member)) {
                $website = new Website();
                $website->url = $websiteUrl;
                $website->short_url = '';
                $website->member()->associate($member);
                if ($this->websiteRepository->create($website)) {
                    $this->created = true;
                    BaseRespository::commit();
                    return $member->id;
                }
            }
            return $this->created;
        } catch (Exception $e) {
            BaseRespository::rollback();
            throw $e;
        }
    }
}
