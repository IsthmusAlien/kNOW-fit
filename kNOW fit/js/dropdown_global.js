var ele1 = document.querySelector(".header_dropdown_tab");

function drop_tab(){
  if(ele1.style.display == "none"){
      ele1.style.display = "flex";
      ele1.style.flex = "column";
  }
  else{
      ele1.style.display = "none";
  }
}

var ele2 = document.querySelector(".header_dropdown_mob");

function drop_mob(){
  if(ele2.style.display == "none"){
      ele2.style.display = "flex";
      ele2.style.flex = "column";
  }
  else{
      ele2.style.display = "none";
  }
}