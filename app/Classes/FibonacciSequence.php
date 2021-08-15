<?php

namespace App\Classes;

class FibonacciSequence
{
    private int $number;

    /**
     * 建構子
     *
     * @param int $parameter
     */
    public function __construct(int $parameter)
    {
        $this->number = $parameter;
    }

    /**
     * 取得輸出
     *
     * @return int
     */
    public function getOutput() : int
    {
        return $this->count($this->number);
    }

    /**
     * 計算
     *
     * 需留意此處遞迴次數會影響伺服器回應時間
     *
     * @param int $number
     * @return int
     */
    private function count(int $number) : int
    {
        if ($number == 1) {
            return 0;
        }

        if ($number == 2) {
            return 1;
        }

        return $this->count($number - 1) + $this->count($number - 2);
    }
}
