<?php

namespace Controller;

use Model\Model;

class Project extends Auth
{
    private $projectModel = null;

    public function __construct()
    {
        if ($this->isAuth() == false) {
            $this->writeJson(10001, '用户未登录');
        }

        $this->projectModel = new Model('t_project');
        $this->activityModel = new Model('t_activity');
    }

    public function getAllProject()
    {
        $uid = 0;

        $condition = array(
            'status' => 1,
            'project_id' => $projectId
        );
        
        $ret = $this->activityModel->read($condition);
        if ($ret === false) {
            $this->writeJson(1003, '记录添加失败');
        }

        $this->writeJson($ret);
    }

    public function add()
    {
        $content = $this->getParam('content');

        if (empty($content)) {
            $this->writeJson(1002, '参数非法');
        }

        $data = array(
            'status' => 1,
            'name' => $content,
        );

        $ret = $this->projectModel->writeToTable($data);
        if ($ret === false) {
            $this->writeJson(1003, '记录添加失败');
        }
        
        $this->writeJson();
    }

    public function delete()
    {

    }
}