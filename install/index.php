<?
global $MESS;
$PathInstall = str_replace('\\', '/', __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen('/index.php'));
IncludeModuleLangFile($PathInstall.'/install.php');
include($PathInstall.'/version.php');

if (class_exists('slobel_baseurl')) return;

class slobel_baseurl extends CModule
{
	const MODULE_ID = 'slobel.baseurl';
	var $MODULE_ID = 'slobel.baseurl';
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;
	public $PARTNER_NAME;
	public $PARTNER_URI;
	public $MODULE_GROUP_RIGHTS = 'N';

	function __construct()
	{
		$arModuleVersion = array();

		$path = str_replace('\\', '/', __FILE__);
		$path = substr($path, 0, strlen($path) - strlen('/index.php'));
		include($path.'/version.php');

		if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
		{
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

		$this->PARTNER_NAME = GetMessage("SL_PARTNER_NAME");
		$this->PARTNER_URI = 'http://slobel.ru/';

		$this->MODULE_NAME = GetMessage('SL_MODULE_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('SL_MODULE_DESCRIPTION');
	}

	function DoInstall()
	{
		RegisterModuleDependences('main', 'OnEndBufferContent', self::MODULE_ID, 'SL_ChangeBaseUrl', 'Handler');
		RegisterModule(self::MODULE_ID);
	}

	function DoUninstall()
	{
		UnRegisterModuleDependences('main', 'OnEndBufferContent', self::MODULE_ID, 'SL_ChangeBaseUrl', 'Handler');
		UnRegisterModule(self::MODULE_ID);
	}
}
?>