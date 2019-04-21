<?php

namespace Controller;

use Model\Model;

class Activity extends Auth
{
    private $activityModel = null;

    public function __construct()
    {
        if ($this->isAuth() == false) {
            $this->writeJson(10001, '用户未登录');
        }

        $this->projectModel = new Model('t_project');
        $this->activityModel = new Model('t_activity');
    }

    public function getListByProjectId()
    {
        $projectId = $this->getParam('project_id');

        if (empty($projectId)) {
            $this->writeJson(1002, '参数非法');
        }

        $condition = array(
            'status' => 1,
            'project_id' => $projectId
        );
        
        $ret = $this->activityModel->read($condition);
        if ($ret === false) {
            $this->writeJson(1003, '查询出错');
        }

        $this->writeJson($ret);
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

    public function setFinished()
    {

    }

    public function setText()
    {

    }

}