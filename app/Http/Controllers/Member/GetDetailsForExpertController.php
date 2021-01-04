<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\Member\GetDetailsForExpertService;
use Exception;
use Illuminate\Support\Facades\Validator;
use stdClass;

class GetDetailsForExpertController extends Controller
{
    private $code = 0;
    private $message = '';
    private $body;
    /**
     * @codeCoverageIgnore
     */
    public function __invoke(GetDetailsForExpertService $service, $id, $topic)
    {

        $this->body = new stdClass();
        try {
            $validator = Validator::make(['memberId' => $id], [
                'memberId' => 'required|int|gte:1'
            ]);
            if ($validator->fails()) {
                throw new Exception('Invalid memberId passed.', 105);
            }

            $member = $service($id, $topic);
            if ($member) {
                $this->body = ['member' => $member];
                $this->code = 1;
                $this->message = 'Experts for topic & not friends of member fetched successfully.';
            } else {
                $this->body = ['member' => $member];
                $this->code = 104;
                $this->message = 'Experts not found.';
            }
        } catch (Exception $e) {
            $this->code = $e->getCode();
            $this->message = $e->getMessage();
        } finally {
            return response()->json([
                'header' => [
                    'code' => $this->code,
                    'message' => $this->message
                ],
                'body' => $this->body
            ]);
        }
    }
}
