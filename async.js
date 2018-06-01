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
					document.getElementById("posts").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","posts.php",true);
			xmlhttp.send();
		}
		
function homepagerightcolumnnotifi(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("notifi").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","notifications.php",true);
			xmlhttp.send();
		}

function homepagerightcolumnarti(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("arti").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","articles.php",true);
			xmlhttp.send();
		}
		
function aboutpagecontent(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("aboutf").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","about.php",true);
			xmlhttp.send();
		}
		
function loadfooterlinks(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("linku").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","footer.php",true);
			xmlhttp.send();
		}
		
function loadsessionlinks(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("videoshere").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","sessions.php",true);
			xmlhttp.send();
		}
		
		
function snackbarr() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function submitForm(){
    var forme = document.getElementById('commentform');
	var formData = new FormData(forme);
	var xhr = new XMLHttpRequest();
	snackbarr();
	xhr.open('POST', 'usercommenting.php', true);
	xhr.send(formData);
}

