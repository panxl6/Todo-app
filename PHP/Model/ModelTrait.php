<?php

namespace Model;

trait ModelTrait
{
    // 非递归字段混淆
    public function encapsulateFields($data, $saltPrefix='f')
    {
        $container = array();
        foreach ($data as $key => $value) {
            $container[$saltPrefix.$key] = $value;
        }

        return $container;
    }


    // 递归字段脱敏
    public function escapeFields($data, &$respContainer=array(), $prefixLen=1)
    {
        if (empty($data)) {
            return;
        }

        if (!is_array($data)) {
            $respContainer = $data;
            return;
        }

        foreach ($data as $key => $value) {

            $newKey = is_numeric($key) ? $key: substr($key, $prefixLen);

            if (!is_array($value)) {
                $respContainer[$newKey] = $value;
                continue;
            }

            $this->escapeFields($value, $respContainer[$newKey]);
        }
    }
}