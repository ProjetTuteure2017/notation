function Chargement() { 
		var e = document.getElementById("selectProjet");
		var strUser="";
		if(e != null){
			e.addEventListener("click",function(){
				var input = document.getElementsByName("idprojet");
				//$a.each( function(index, value) {
				input[0].value = e.options[e.selectedIndex].value;
				//});
			});
		}
	  }
	  
function Verif_Selection(){
		  var options = document.getElementById("selectProjet").options;
		  for(var i=0; i< options.length;i++){
			  if(options[i].selected){
				return true;
			  }
		  }
		  alert("Veuillez selectionner un projet");
		  return false;
}

function Verif_Selection_Comp(){
	var options = document.getElementById("selectProjet").options;
	var options_grille = document.getElementById("selectGrille").options;
	for(var i=0; i< options.length;i++){
		for(var j=0; j< options_grille.length;j++){
			if(options[i].selected && options_grille[j].selected)
				return true;
		}
	}
	alert("Veuillez selectionner une grille");
	return false;
}