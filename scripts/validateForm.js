function validate(fields)
{
	for(var i=0; i<fields.length; i++)
	{
		if((fields[i].value == null || fields[i].value == "") && fields[i].getAttribute("type")!="checkbox")
		{
			alert("Before submitting you must complete: " + fields[i].getAttribute("name"));
			return false;
		}
	}
	
	return true;
}
function validate_data_entry()
{
	var fields = document.forms["data_form"].getElementsByTagName("input");
	return validate(fields);
}