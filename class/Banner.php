<?

/**
 * @author Mikhail Starovoyt
 * @author Mikhail Kuleshov
 *
 */

class Banner extends Base
{
	//-----------------------------------------------------------------------------------------------
	function __construct()
	{
		Base::$bXajaxPresent=true;
	}
	//-----------------------------------------------------------------------------------------------
	public function GetRandomBanner($sSection)
	{
		$sWhereRegion=" and region='".Base::$aRequest['CountryCode']."'";
			
		$aBanner=Db::GetRow(Base::GetSql('Banner',array(
		'where'=>" and b.section='".$sSection."' and b.visible='1'".$sWhereRegion,
		'order'=>" order by rand()",
		)));

		return $aBanner['description'];
	}
	//-----------------------------------------------------------------------------------------------
	public function ProductBannerSateChange()
	{
		Db::AutoExecute('banner', array('visible'=>0), 'UPDATE',"section='product_top'");
		if (!Base::$aRequest['banner_state']) return;
		Db::AutoExecute('banner', array('visible'=>1), 'UPDATE',"section='product_top' and num='".Base::$aRequest['banner_state']."'");
	}
	//-----------------------------------------------------------------------------------------------
}
?>