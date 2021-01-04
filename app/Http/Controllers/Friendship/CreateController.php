<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use App\Services\Friendship\CreateService;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class CreateController extends Controller
{
    private $code = 0;
    private $message = '';
    private $body;
    /**
     * @codeCoverageIgnore
     */
    public function __invoke(CreateService $service, Request $request)
    {
        $this->body = new stdClass();
        try {
            $validated = $request->validate([
                'memberId' => 'required|',
                'friendId' => 'required|different:memberId',
            ]);
            if ($validated) {
                if ($service($request->input('memberId'), $request->input('friendId'))) {
                    $this->code = 1;
                    $this->message = 'Friendship created successfully';
                }
            } else {
                $this->code = 101;
                $this->message = 'Invalid Input parameters';
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
