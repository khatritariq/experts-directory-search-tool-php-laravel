<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\Member\CreateService;
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
                'name' => 'required|max:100',
                'websiteUrl' => 'required|max:100',
            ]);
            if ($validated) {
                $memberId = $service($request->input('name'), $request->input('websiteUrl'));
                if ($memberId > 0) {
                    $this->body = ['id' => $memberId];
                    $this->code = 1;
                    $this->message = 'Member created successfully';
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
