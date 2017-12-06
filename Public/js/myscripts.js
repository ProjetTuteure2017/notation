var $ = function(id) { return document.getElementById(id); };

function showHide(target) {

	ourDiv = $(target);

	if(ourDiv.className == 'opened')
	{
    	ourDiv.className = 'closed';
	}
	else if(ourDiv.className == 'closed')
	{
    	ourDiv.className = 'opened';
	}

}