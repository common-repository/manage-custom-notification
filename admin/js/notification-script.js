function insert_form_valid_check()
{
	if(document.getElementById('title').value.trim()=="")
	{
		document.getElementById('title').style.border="1px solid #dc8a8a";
		return false;
	}
	if(document.getElementById('content').value.trim()=="")
	{
		document.getElementById('content').style.border="1px solid #dc8a8a";
		return false;
	}
	if(document.getElementById('link_check').checked==true)
	{
		if(document.getElementById('link').value.trim()=="http://")
		{
			document.getElementById('link').style.border="1px solid #dc8a8a";
			return false;
		}
	}
}
function link_che()
{
	if(document.getElementById('link_check').checked==true)
	{
		document.getElementById('link_p').style.display="block";
		document.getElementById('link_check').value=1;
		document.getElementById('link').value="http://";
	}else{
		document.getElementById('link_p').style.display="none";
		document.getElementById('link_check').value=0;
		document.getElementById('link').value="";
		document.getElementById('target_check').checked=false;
	}
}

function how_many()
{
	var checkedValue = ""; 
	var inputElements = document.getElementsByClassName('delete_check_class');
	for(var i=0; inputElements[i]; ++i)
	{
      	if(inputElements[i].checked)
      	{
           checkedValue += inputElements[i].value +",";
      	}
	}
	document.getElementById('notification_id').value=checkedValue;
	document.getElementById("deleteForm").submit();
}
function all_check_top()
{
	if(document.getElementById('root_checkbox_id_top').checked==true)
	{
		document.getElementById('root_checkbox_id_bottom').checked=true;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('root_checkbox_id_bottom').checked=false;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function all_check_bottom()
{
	if(document.getElementById('root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('root_checkbox_id_top').checked=true;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('root_checkbox_id_top').checked=false;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function each_check(which_id)
{
	var inputElements = document.getElementsByClassName('delete_check_class');
	if(document.getElementById('root_checkbox_id_top').checked==true || document.getElementById('root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('root_checkbox_id_top').checked=false;
		document.getElementById('root_checkbox_id_bottom').checked=false;
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
			if(inputElements[i].value==which_id)
			{
				inputElements[i].checked=false;
			}		
		}
	}
}
