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

    /**
     * 依照聊天室編號取得訊息資料
     *
     * @param int $chatRoomId
     * @return array
     */
    public function getByChatRoomId(int $chatRoomId) : array
    {
        $sql = "SELECT * FROM `MessageLog` WHERE `chatRoomId` = :id AND `isCommand` = FALSE";
        $bindingValues = array(
            ':id' => $chatRoomId
        );

        $messages = array();
        $selectedRows = DB::select($sql, $bindingValues);
        if (empty($selectedRows)) {
            return array();
        }

        foreach ($selectedRows as $selectedRow) {
            $messageLog = new MessageLog();
            $messageLog->loadFromStdClass($selectedRow);
            $messages[] = $messageLog;
        }

        return $messages;
    }
}
