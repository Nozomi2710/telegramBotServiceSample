<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use TelegramBot\Api\Client;
use TelegramBot\Api\Exception;
use TelegramBot\Api\Types\Message;

class TelegramBot
{
    private Client $botClient;

    /**
     * 建構子
     */
    public function __construct()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $this->botClient = new Client($token);
        $this->initializedCommand();
    }

    /**
     * 初始化指令
     */
    private function initializedCommand()
    {
        try {
            $this->botClient->command('help', function (Message $message) {
                $this->replyHelpCommand($message);
            });

            $this->botClient->command('test', function (Message $message) {
                $this->replyTestCommand($message);
            });

            $this->botClient->command('fib', function (Message $message) {
                $this->replyFibonacciSequenceCommand($message);
            });

            $this->botClient->run();
        } catch (Exception $exception) {
            Log::error('初始化機器人指令有誤', array('message' => $exception->getMessage()));
        }
    }

    /**
     * 回復 /help
     *
     * @param Message $message
     */
    private function replyHelpCommand(Message $message)
    {
        $commands = array(
            '/test： 機器人回應 「test too!」',
            '/fib [整數]： 機器人回傳費氏數列第 n 項，請給予 1 ~ 25 內的數字，為避免伺服器回應過慢，暫不開放 25 以上的項目回應'
        );
        $this->botClient->sendMessage($message->getChat()->getId(), implode("\r\n", $commands));
    }

    /**
     * 回覆 /test
     *
     * @param Message $message
     */
    private function replyTestCommand(Message $message)
    {
        $this->botClient->sendMessage($message->getChat()->getId(), 'test too!');
    }

    /**
     * 回覆 /fib
     *
     * @param Message $message
     */
    private function replyFibonacciSequenceCommand(Message $message)
    {
        $command = "/fib";
        $chatId = $message->getChat()->getId();
        $parameter = Str::after($message->getText(), $command);
        if ( ! is_numeric($parameter)) {
            $this->botClient->sendMessage($chatId, '請輸入整數作為參數');
            return;
        }

        if ($parameter == 0) {
            $this->botClient->sendMessage($chatId, '無效的參數');
            return;
        }

        if ($parameter > 25) {
            $this->botClient->sendMessage($chatId, '抱歉，為避免回應過慢，伺服器目前僅接受 25 (含)以下的整數作為參數');
            return;
        }

        $fibonacciSequence = new FibonacciSequence((int)$parameter);

        $this->botClient->sendMessage($chatId, $fibonacciSequence->getOutput());
    }
}
