<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\Member\GetAllService;
use Exception;
use stdClass;

class GetAllController extends Controller
{
    private $code = 0;
    private $message = '';
    private $body;
    /**
     * @codeCoverageIgnore
     */
    public function __invoke(GetAllService $service)
    {
        $this->body = new stdClass();
        try {
            $members = $service();
            $this->body = ['members' => $members];
            $this->code = 1;
            $this->message = 'List of all members.';
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
