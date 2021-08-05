<?php

namespace App\Models;

use App\Classes\MessageLog;
use Illuminate\Support\Facades\DB;

class MessageLogModel
{
    /**
     * 新增訊息紀錄
     *
     * @param MessageLog $messageLog
     * @return bool
     */
    public function add(MessageLog $messageLog) : bool
    {
        $sql = "INSERT INTO `MessageLog`
                    (`isCommand`, `message`, `chatRoomId`, `userId`, `datetime`)
                VALUES
                    (:isCommand, :message, :chatRoomId, :userId, :datetime)";
        $bindingValues = array(
            ':isCommand' => $messageLog->isCommand(),
            ':message' => $messageLog->getMessage(),
            ':chatRoomId' => $messageLog->getChatRoomId(),
            ':userId' => $messageLog->getUserId(),
            ':datetime' => $messageLog->getDatetime()
        );

        return DB::insert($sql, $bindingValues);
    }


    public function getByChatRoomId(int $id)
    {

    }
}
