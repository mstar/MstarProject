//-----------------------------------------------------------------------------
function place_cursor()
{
	try {
		if (document.forms[0] && document.forms[0][0])	document.forms[0][0].focus();
	} catch(err) {}
}
//-----------------------------------------------------------------------------
function show_hide(layer,value){
	blok=document.getElementById(layer);
	if(blok){
		if(blok.style.display == 'none' || value=='inline'){
			blok.style.display = 'inline';
		}else{
			blok.style.display = 'none';
		}
	}
}
//-----------------------------------------------------------------------------