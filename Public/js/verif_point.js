function verification(){
	var nbPointList = document.getElementsByName('nombrePoint');
	var noteList = document.getElementsByName('note');
		
	for(var i=0; i<nbPointList.length; i++){
		var nbPoint = parseInt(nbPointList[i].value,10);
		var note = parseInt(noteList[i].value,10);
		if(note>nbPoint || note<0){
			alert("Une note est inferieure à 0 ou supperieur au nombre de point maximum");
			return false;
		}
	}
	return true;
}
