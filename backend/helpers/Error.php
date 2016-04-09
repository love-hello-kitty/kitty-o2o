<?php

namespace backend\helpers;

class Error
{
    const SUCCESS = 0;
	const ERR_UNKNOW = -1;
	const ERR_FAIL = 10001;
	const ERR_NOID = 10002;
	const ERR_NOUSER = 10003;
	const ERR_PASSWORD = 10004;
	const ERR_ACCOUNT_EXISTS = 10005;
	const ERR_ACCOUNT_NOT_EXISTS = 10006;

	public static function output($errorCode = '',$data = []) {
		$errorMsg = self::getErrorInfo();
		if(!isset($errorMsg[$errorCode])) {
			$errorCode = self::ERR_UNKNOW;
		}
		
		$error = [
			'errorCode' => $errorCode,
			'errorText' => $errorMsg[$errorCode]
		];
		if (!empty($data)) {
		    $error['data'] = $data;
		}
		header('Content-Type: text/plain');
        echo json_encode($error);
        exit;
	}

	public static function getErrorInfo() {
		return [
		    self::SUCCESS                       => '成功', 
			self::ERR_UNKNOW 		            => '未知错误',
			self::ERR_FAIL 			            => '失败',
			self::ERR_NOID         	            => '缺少ID',
			self::ERR_NOUSER         	        => '用户不存在',
			self::ERR_PASSWORD         	        => '密码有误',
			self::ERR_ACCOUNT_EXISTS         	=> '账号已存在',
			self::ERR_ACCOUNT_NOT_EXISTS        => '账号不存在',
		];
	}
}