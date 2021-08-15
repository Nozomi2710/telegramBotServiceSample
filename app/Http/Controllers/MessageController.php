<?php

namespace App\Http\Controllers;

use App\Classes\MessageLog;
use App\Classes\TelegramBot;
use App\Models\MessageLogModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class MessageController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logMessage(Request $request) : \Illuminate\Http\JsonResponse
    {
        $log = new MessageLog();
        $log->setMessage($request->input('message.text', ''));
        $log->setDatetime($request->input('message.date', Carbon::today()));
        $entities = $request->input('message.entities', array());
        if (empty($entities)) {
            $log->setIsCommand(false);
        } else {
            $entity = array_pop($entities);
            $log->setIsCommand($entity['type'] == 'bot_command');
        }

        $log->setChatRoomId($request->input('message.chat.id', 0));
        $log->setUserId($request->input('message.from.id', 0));

        $model = new MessageLogModel();
        $success = $model->add($log);
        $bot = new TelegramBot();

        return response()->json(array(), $success ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
