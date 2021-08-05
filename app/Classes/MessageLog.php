<?php

namespace App\Classes;

class MessageLog
{
    private int $id = 0;
    private bool $isCommand = false;
    private string $message = '';
    private int $chatRoomId = 0;
    private int $userId = 0;
    private int $datetime = 0;

    /**
     * 取得編號
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * 設定編號
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * 是否為指令
     *
     * @return bool
     */
    public function isCommand(): bool
    {
        return $this->isCommand;
    }

    /**
     * 設定是否為指令
     *
     * @param bool $isCommand
     */
    public function setIsCommand(bool $isCommand): void
    {
        $this->isCommand = $isCommand;
    }

    /**
     * 取得訊息內容
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * 設定訊息內容
     *
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * 取得聊天室編號
     *
     * @return int
     */
    public function getChatRoomId(): int
    {
        return $this->chatRoomId;
    }

    /**
     * 設定聊天室編號
     *
     * @param int $chatRoomId
     */
    public function setChatRoomId(int $chatRoomId): void
    {
        $this->chatRoomId = $chatRoomId;
    }

    /**
     * 取得使用者編號
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * 設定使用者編號
     *
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * 取得時間日期戳記
     *
     * @return int
     */
    public function getDatetime(): int
    {
        return $this->datetime;
    }

    /**
     * 設定時間日期戳記
     *
     * @param int $datetime
     */
    public function setDatetime(int $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * 從 stdClass 載入
     *
     * @param \stdClass $content
     */
    public function loadFromStdClass(\stdClass $content) : void
    {
       $this->setId($content->id ?? 0);
       $this->setChatRoomId($content->chatRoomId ?? 0);
       $this->setUserId($content->userId ?? 0);
       $this->setIsCommand($content->isCommand ?? false);
       $this->setMessage($content->message ?? '');
       $this->setDatetime($content->datetime ?? 0);
    }
}
