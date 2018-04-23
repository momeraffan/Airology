function loadlinks(){
			// code for IE7+, Firefox, Chrome, Opera, Safari
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("navi").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","nav.php",true);
			xmlhttp.send();
		}