function loadlinks(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("navi").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","nav.php",true);
			xmlhttp.send();
		}

function homepageleftcolumn(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("navi").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","left.php",true);
			xmlhttp.send();
		}
		
function homepagerightcolumn(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("navi").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","right.php",true);
			xmlhttp.send();
		}
		
function aboutpagecontent(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("aboutf").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","about.pshp",true);
			xmlhttp.send();
		}
		
function snackbarr() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}