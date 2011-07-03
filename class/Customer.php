<?

/**
 * @author Mikhail Starovoyt
 *
 */

class Customer extends Base
{
	//-----------------------------------------------------------------------------------------------
	function __construct()
	{
		Auth::NeedAuth('customer');
	}
	//-----------------------------------------------------------------------------------------------
	public function Index()
	{
		$this->Profile();
	}
	//-----------------------------------------------------------------------------------------------
	public function Profile()
	{
		Base::$aTopPageTemplate=array('panel/tab_customer.tpl'=>'profile');

		if (Base::$aRequest['is_post']) {
			$aUserCustomer=String::FilterRequestData(Base::$aRequest['data'],array(
			'name','city','address','phone','remarks','id_currency','remark'
			));
			Db::Autoexecute('user_customer',$aUserCustomer,'UPDATE',"id_user='".Auth::$aUser['id']."'");

			$aUser=String::FilterRequestData(Base::$aRequest['data'],array('email'));
			if (!String::CheckEmail($aUser['email'])) {
				$aUser['email']='';
				$sError.=Language::GetMessage("Not valid email and will be set to empty.");
			}
			Base::$db->Autoexecute('user',$aUser,'UPDATE',"id='".Auth::$aUser['id']."'");
			Auth::$aUser=Auth::IsUser(Auth::$aUser['login'],Auth::$aUser['password']);

			if (Auth::$aUser['has_forum']){
				Forum::ChangeProfile(Auth::$aUser);
			}
		}

		Auth::RefreshSession(Auth::$aUser);
		//Auth::$aUser['amount_currency']=Base::$oCurrency->PrintPrice(Auth::$aUser['amount'],Auth::$aUser['id_currency']);

		Base::$tpl->assign('aUser',Auth::$aUser);
		Base::$tpl->assign('sManagerLogin',Base::$db->getOne("select login from user where id='".Auth::$aUser['id_manager']."'"));
		Base::$tpl->assign('sManagerName',Base::$db->getOne("select name from user_manager where id_user='".Auth::$aUser['id_manager']."'"));

		Base::$tpl->assign('aCurrency',$aCurrency);

		$aData=array(
		'sHeader'=>"method=post",
		'sTitle'=>"Customer Profile",
		'sContent'=>Base::$tpl->fetch('customer/profile.tpl'),
		'sSubmitButton'=>'Apply',
		'sSubmitAction'=>'customer_profile',
		'sError'=>$sError,
		);
		$oForm=new Form($aData);
		Base::$sText.=$oForm->getForm();

		//Base::$tpl->assign('sForm',);
		//Base::$sText.=Base::$tpl->fetch('user/outer_profile.tpl');
	}
	//-----------------------------------------------------------------------------------------------
	public function IsChangeableLogin($sLogin) {
		return preg_match("/^[a-zA-Z]{1}[0-9]*$/", $sLogin);
	}
	//-----------------------------------------------------------------------------------------------

}
?>