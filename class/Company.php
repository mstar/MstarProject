<?
/**
 * @author Mikhail Starovoyt
 */

class Company extends Base
{
	public function Index()
	{
		$oTable=new Table();
		$oTable->sSql=Base::$language->GetLocalizedAll(array(
		'table'=>'company',
		'where'=>" and t.visible=1",
		),true);
		$oTable->aOrdered="order by t.name";
		$oTable->aColumn=array(
		'full'=>array('sTitle'=>'Site News','sWidth'=>'100%'),
		);
		$oTable->sDataTemplate='company/row_company.tpl';
		$oTable->bStepperVisible=fasle;
		$oTable->bHeaderVisible=false;
		$oTable->iRowPerPage=30;
		Base::$sText.=$oTable->getTable();
	}
	//-----------------------------------------------------------------------------------------------

}
?>