function closeOpenNav(x){
  document.getElementById("navList").classList.toggle("show");
  x.classList.toggle("moveRight");
  if(x.classList.contains("moveRight")){
    x.innerHTML="X";
  }
  else{
    x.innerHTML="\u2261";
  }
}
function w3_open(){
	document.getElementById("mySidebar").style.display = "block";
	document.getElementById("myOverlay").style.display = "block";
}
function w3_close(){			
	document.getElementById("mySidebar").style.display = "none";
	document.getElementById("myOverlay").style.display = "none";
}