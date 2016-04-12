<?php

namespace storebackend\helpers;

class Error
{
    const SUCCESS = 0;
	const ERR_UNKNOW = -1;
	const ERR_ILLEGAL = -2;
	const ERR_FAIL = 10001;
	const ERR_NOID = 10002;
	const ERR_NOUSER = 10003;
	const ERR_PASSWORD = 10004;
	const ERR_NOPWD = 10005;
	const ERR_PASSWORD_TOO_LONG	= 10006;
	const ERR_OLD_PASSWORD_ERROR = 10007;
	const ERR_PWDNOEQUAL = 10008;
	const ERR_NO_CONSUME_CODE = 10009;
	const ERR_CONSUME_CODE_ERROR = 10010;
	const ERR_ALREADY_CONSUME = 10011;
	const ERR_NO_STORE = 10012;
	
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

	public static function getErrorInfo()
	{
		return [
		    self::SUCCESS                       => '成功',
			self::ERR_UNKNOW 		            => '未知错误',
			self::ERR_ILLEGAL 		            => '非法操作',
			self::ERR_FAIL 			            => '失败',
			self::ERR_NOID         	            => '缺少ID',
			self::ERR_NOUSER         	        => '账号不存在',
			self::ERR_PASSWORD         	        => '密码有误',
			self::ERR_NOPWD						=> '密码不能为空',
			self::ERR_PASSWORD_TOO_LONG			=> '密码过长',
			self::ERR_OLD_PASSWORD_ERROR		=> '原密码有误',
			self::ERR_PWDNOEQUAL				=> '两次密码不一致',
			self::ERR_NO_CONSUME_CODE		    => '消费码不能为空',
			self::ERR_CONSUME_CODE_ERROR		=> '消费码有误',
			self::ERR_ALREADY_CONSUME		    => '您已经消费',
			self::ERR_NO_STORE		            => '商家不存在',
		];
		
	}
}