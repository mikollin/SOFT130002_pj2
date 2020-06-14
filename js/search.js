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

let mchoice=getQueryVariable('choice');
let mtitle=getQueryVariable('filter_title');
let mdescription=getQueryVariable('filter_description');
let choice=document.getElementsByName('choice');
let title=document.getElementById('frame1');
let description=document.getElementById('frame2');
if(mtitle)
title.value=mtitle;
else
    title.va =null;
if(mdescription)
description.value=mdescription;
else
    description.value=null;

    if (mchoice == "Filter_by_Title") {
        choice[0].selected;
    } else if (mchoice == "Filter_by_Description") {
        choice[1].selected;
    }