/**************************************************************/
/* Prepares the cv to be dynamically expandable/collapsible   */
/**************************************************************/
function prepareList() {
    var parentList = document.getElementById("expList");
    var listChildren = parentList.children;
    for(i=0; i<listChildren.length; i++) {
        for(j=0; j<listChildren[i].children.length; j++) {
            listChildren[i].children[j].style.display = 'none';
            listChildren[i].children[j].classList.add("collapsed");
        }
        listChildren[i].onclick = scopepreserver(listChildren[i].id);   
        listChildren[i].classList.add("collapsed");
    }
};

function scopepreserver(id) {
  return function () {
    element = document.getElementById(id)
    element.style.display = 'block';
    if(element.classList.contains("expanded")) {
        element.classList.remove("expanded");    
    } else {
        element.classList.add("expanded");    
    }
      
    for(i = 0; i<element.children.length; i++) {
        if(element.children[i].style.display == "block") {
            element.children[i].style.display = 'none';      
        }else {
            element.children[i].style.display = 'block';      
        }
      
      element.children[i].classList.remove("collapsed");
    }
  };
}
/**************************************************************/
/* Functions to execute on loading the document               */
/**************************************************************/