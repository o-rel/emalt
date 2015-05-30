function hide_show(id) {
	if(document.getElementById(id).style.display=="none") {
		document.getElementById(id).style.display="block";
	} else {
		document.getElementById(id).style.display="none";
	}
	return true;
}

function getXhr()
{                
	var xhr = null; 
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
	            xhr = new ActiveXObject("Msxml2.XMLHTTP");
	        } catch (e) {
	            xhr = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	}
	else { // XMLHttpRequest non supporté par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	} 
	return xhr;
}

function getCourses()
{
	var xhr = getXhr();
	
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById('CoursesUserInstrumentId').innerHTML = leselect;
		}
	};
 
	// Ici on va voir comment faire du post
	xhr.open("POST","ajaxLivre.php",true);
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	// ici, l'id de l'auteur
	sel = document.getElementById('auteur');
	idauteur = sel.options[sel.selectedIndex].value;
	xhr.send("idAuteur="+idauteur);
}

function paginate_number(page) {
	reg = new RegExp('\/page:[0-9]*', 'g');
	loc = window.location.pathname;
	if (reg.test(loc)) {
		window.location = window.location.pathname.replace(new RegExp('\/page:[0-9]*', 'g'), '')+'/page:'+page;
	} else {
		reg = new RegExp('/index');
		if (reg.test(loc)) {
			window.location = window.location.pathname + '/page:' + page;
		} else {
			window.location = window.location.pathname + '/index/page:' + page;
		}
	}
	
	//element = document.getElementById
}

/*function load_score(id) {
	$.ajax({
		type : "POST",
		url : "<?php echo Router::url(array('controller' => 'scores' => 'action' => 'ajaxGetScore', 'admin' => true, id)); ?>",
		data : {
			id : id
		},
		success: function(){
			
		}
	})
}*/

/*$('.score_list.score').click(function(){
	alert('toto');
	//$('#score_content').html('TAAAAADAAAAAAAAAAA');
});*/

$(document).ready( function() {
    $("#forgot,#closeLink").click( function () { popup('popUpDiv')});
});

function toggle(div_id) {
	var el = document.getElementById(div_id);
	if ( el.style.display == 'none' ) {	el.style.display = 'block';}
	else {el.style.display = 'none';}
}
function blanket_size(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportheight = window.innerHeight;
	} else {
		viewportheight = document.documentElement.clientHeight;
	}
	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
		blanket_height = viewportheight;
	} else {
		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
			blanket_height = document.body.parentNode.clientHeight;
		} else {
			blanket_height = document.body.parentNode.scrollHeight;
		}
	}
	var blanket = document.getElementById('blanket');
	blanket.style.height = blanket_height + 'px';
	var popUpDiv = document.getElementById(popUpDivVar);
	popUpDiv_height=blanket_height/2-200;//200 is half popup's height
	popUpDiv.style.top = popUpDiv_height + 'px';
}
function window_pos(popUpDivVar) {
	if (typeof window.innerWidth != 'undefined') {
		viewportwidth = window.innerHeight;
	} else {
		viewportwidth = document.documentElement.clientHeight;
	}
	if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
		window_width = viewportwidth;
	} else {
		if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
			window_width = document.body.parentNode.clientWidth;
		} else {
			window_width = document.body.parentNode.scrollWidth;
		}
	}
	var popUpDiv = document.getElementById(popUpDivVar);
	window_width=window_width/2-200;//200 is half popup's width
	popUpDiv.style.left = window_width + 'px';
}
function popup(windowname) {
	blanket_size(windowname);
	window_pos(windowname);
	toggle('blanket');
	toggle(windowname);		
}


