<?php

namespace Controller;

use Model\Model;

class User extends Auth
{
    private $activityModel = null;

    public function __construct()
    {
       // 写死
    }

    public function login()
    {
        
    }

    public function add()
    {
        $projectId = $this->getParam('project_id');
        $content = $this->getParam('content');

        if (empty($projectId) || empty($content)) {
            $this->writeJson(1002, '参数非法');
        }

        $data = array(
            'status' => 1,
            'content' => $content,
            'project_id' => $projectId,
        );

        $ret = $this->activityModel->writeToTable($data);
        if ($ret === false) {
            $this->writeJson(1003, '记录添加失败');
        }

        $this->writeJson();
    }

    public function delete()
    {

    }

}