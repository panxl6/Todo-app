<?php

namespace Library;

class Log
{
	const INFO = 1;
	const DEBUG = 2;
	const WARNING = 3;
	const ERROR = 4;
	
	// 配置
	// 将日志写入文件
	private $logger = null;
	public function __construct($path='')
	{
		if (empty($path)) {
			$path = APP_ROOT .'/Runtime/Log/app.log';
		}
		
		$ret = fopen($path, 'a+');
		if ($ret === false) {
			// todo:异常处理
		}
		$this->logger = $ret;
	}

	public function log($text, $level=1)
	{
		// 根据level信息追加一些上下文环境
		fwrite($this->logger, $text);
	}
}