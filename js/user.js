/**
* @author Mikhail Starovojt
*/

var MstarUser=function (data) {
};


MstarUser.prototype.ToggleUserForm = function()
{
	var oExpire = new Date();
	oExpire.setTime(oExpire.getTime() + (1000 * 60 * 60 * 24 * 90));

	oPriceFormDiv=$('#user_form_div_id');

	if (oPriceFormDiv.css("display")=="none") {
		oPriceFormDiv.show();
		$('#price_link_expand').hide();
		document.cookie = " user_form_visible=1; path=/; expires="+oExpire.toGMTString();
	}
	else {
		oPriceFormDiv.hide();
		$('#price_link_expand').show();
		document.cookie = "user_form_visible=0; path=/; expires="+oExpire.toGMTString();
	}
}

var oMstarUser=new MstarUser();