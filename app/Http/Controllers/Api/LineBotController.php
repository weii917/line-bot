<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class LineBotController extends Controller
{

   
    // 回應訊息
    public function handleWebhook(Request $request)
    {

        // 解析 LINE Webhook 事件
        $events = json_decode($request->getContent(), true);
        // echo $events;
        // dd($events);
        // exit();
        foreach ($events['events'] as $event) {
            if ($event['type'] === 'message' && $event['message']['type'] === 'text') {
                // 取得用戶發送的訊息
                $userMessage = $event['message']['text'];

                // 回應用戶發送的訊息
                $this->sendReplyMessage($event['replyToken'], $userMessage);
            }
        }

        return response('OK', 200);
    }



    private function sendReplyMessage($replyToken, $message)
    {
        $url = 'https://api.line.me/v2/bot/message/reply';

        $data = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $message
                ]
            ]
        ];

        $httpClient = new Client();
        $response = $httpClient->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('LINE_BOT_CHANNEL_ACCESS_TOKEN')
            ],
            'json' => $data
        ]);

        return $response->getStatusCode();
    }

    // --------------------------------------------------------------------------------------------------


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return '123';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
