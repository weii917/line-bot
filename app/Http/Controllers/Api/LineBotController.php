<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class LineBotController extends Controller
{



    public function handleWebhook(Request $request)
    {

       
        $events = json_decode($request->getContent(), true);
        // dd($events);
        foreach ($events['events'] as $event) {
            if ($event['type'] === 'message' && $event['message']['type'] === 'text') {
                // 取得用戶發送的訊息
                // $userMessage = $event['message']['text'];
                // 取得用戶發送的訊息送到open ai
                $userMessage = $this->getMessage($event['message']['text']);


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

    private function getMessage($message)
    {
        try {
            $url = 'https://api.openai.com/v1/chat/completions';

            $data = [
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "你現在是一個貓的訂房網並且提供購物商品的功能，商品有關貓的物品，請到平台訂購"
                    ],
                    [
                        "role" => "user",
                        "content" => $message
                    ]
                ],
                "model" => "gpt-3.5-turbo-0613",
                "temperature" => 0.7,
                "max_tokens" => 150,
                "top_p" => 1,
                "stream" => false
            ];

            $httpClient = new Client();
            $responseAi = $httpClient->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('OPEN_AI_KEY')
                ],
                'json' => $data
            ]);

            $responseBody = json_decode($responseAi->getBody(), true);
            return $responseBody['choices'][0]['message']['content'] ?? '對不起，我無法理解你的意思';
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
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
