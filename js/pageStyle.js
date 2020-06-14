function getQueryVariable(variable)
{
    let query = window.location.search.substring(1);
    let vars = query.split("&");
    for (let i=0;i<vars.length;i++) {
        let pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}


let page= document.getElementById('page');
let currentPage=getQueryVariable('page');
if(currentPage==false)
    currentPage=1;
let now=currentPage.firstElementChild;
for(let i=0;i<currentPage;i++){
    now=page.nextElementSibling;
}
now.style.setProperty('color',"#006699");
now.style.setProperty('font-size',"40px");