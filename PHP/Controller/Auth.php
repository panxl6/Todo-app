<?php

namespace Controller;

class Auth extends Base
{
    public function login()
    {
        $userName = $_POST['user_name'];
        $password = $_POST['password'];

        // TODO:从DB中查询
        if ($userName == 'panxl' && $password == '123456') {
            $this->writeJson(0, '授权成功');
        }

        $this->writeJson(1001, '授权失败');
    }

    protected function isAuth()
    {
        $toekn = $_COOKIE['todo_id'];
        if (empty($toekn)) {
            return false;
        }

        return true;
    }
}