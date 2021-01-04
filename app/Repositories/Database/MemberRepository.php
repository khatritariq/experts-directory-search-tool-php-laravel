<?php

namespace App\Repositories\Database;

use App\Models\Member;
use App\Repositories\Database\Interfaces\IMemberRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use PDO;

/**
 * Class MemberRepository
 * @package App\Domain\Repositories\Database
 * @codeCoverageIgnore
 */

class MemberRepository extends BaseRespository implements IMemberRepository
{
 
    /**
     * @var string
     */
    protected $modelClass = Member::class;

    public function create($model) : bool
    {
        return $model->save();
    }

    public function exists(int $memberId) : bool
    {
        return $this->modelClass::where('id', $memberId)->exists();
    }

    public function getAll() : array
    {
        $members = DB::select(DB::raw(
            'SELECT m.`id`, m.name, w.`url`, w.`short_url` as shortUrl, 
            (SELECT COUNT(*) FROM friendships f WHERE f.member_id= m.id) AS friendsCount
            FROM members m
            INNER JOIN websites w ON w.`member_id` = m.id'
        ));
        return $members;
    }

    public function get($id) : array
    {
        $member = DB::select(
            DB::raw(
            'SELECT m.`id`, m.`name`, w.`url`, w.`short_url`, 
            (SELECT GROUP_CONCAT(wh.header_type, ":",wh.header_content) FROM website_headings wh WHERE w.id = wh.website_id ) AS websiteHeadings,
            (SELECT GROUP_CONCAT(f.friend_id) FROM friendships f WHERE f.member_id= m.id) AS friendsIds
            FROM members m
            INNER JOIN websites w ON w.`member_id` = m.id
            WHERE m.id= :p_id LIMIT 1;'
            ),
            ['p_id' => $id]
        );
        if (!empty($member)) {
            return (array)$member[0];
        } else {
            throw new Exception('No member found', 106);
        }
    }

    public function getMemberWithTopicExpert(int $id, string $topic) : array
    {
        $member = DB::select(
            DB::raw(
            'SELECT m.id, m.`name`, wh.`header_type`, wh.`header_content` FROM website_headings wh
            INNER JOIN websites w ON wh.`website_id` = w.`id`
            INNER JOIN members m ON w.`member_id` = m.`id`
            WHERE wh.`header_content` LIKE :p_topic
            AND w.`member_id` IN 
            (SELECT m.id FROM members m 
            WHERE m.`id` NOT IN ( SELECT friend_id FROM friendships f WHERE member_id = :p_id1 )
            AND m.`id` != :p_id2 );'
            ),
            [
                'p_topic' => '%'.$topic.'%',
                'p_id1' => $id,
                'p_id2' => $id
            ]
        );
        if (!empty($member)) {
            return (array)$member;
        } else {
            throw new Exception('No expert for topic found', 107);
        }
    }
}
