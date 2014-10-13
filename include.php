<?
class SL_ChangeBaseUrl
{
	public static function Handler(&$content)
	{
		if (!defined('ADMIN_SECTION') || ADMIN_SECTION!==true)
			 $content = preg_replace_callback('#\<head\>(.*?)\<\/head\>#is',
									create_function(
									'$matches',
									'$url="http://".$_SERVER["SERVER_NAME"]."/";
									if (strpos($matches[0], "<base")===false)
											return "<head>$matches[1]\n<base href=\"$url\"/></head>";
									else
										return $matches[0];'
								),
								$content);
		
	}
}
?>