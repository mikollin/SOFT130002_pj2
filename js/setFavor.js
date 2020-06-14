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

// alert(getQueryVariable('path'));
// alert(getQueryVariable('title'));
// alert(getQueryVariable('description'));
// alert(getQueryVariable('country'));
// alert(getQueryVariable('city'));
//  alert(getQueryVariable('content'));
//  alert(getQueryVariable('author'));
//alert(getQueryVariable('favored'));

let mpath=getQueryVariable('path');
//
// let mtitle=getQueryVariable('title');
// let mdescription=getQueryVariable('description');
// let mcountry=getQueryVariable('country');
// let mcity=getQueryVariable('city');
// let mcontent=getQueryVariable('content');
// let mauthor=getQueryVariable('author');
// // let mfavorNum=getQueryVariable('favorNum');
// let mfavored=getQueryVariable('favored');

// if(mpath!=false&&mtitle!=false&&mdescription!=false&&mcountry!=false&&mcity!=false&&mcontent!=false&&mauthor!=null)
// {
//     setFavor();
// }
 if(mpath!=false) {
    // alert("为助教提供的原始数据，信息可能不全！用户上传一定信息完整！");
    // setFavor();
}else{
    alert("为助教提供的原始数据,找不到这张图片在哪里，因此没有保存到本机对应的文件夹中，只能看到备用图片,这里自动回到首页...");
    window.location.href='../index.php';
}

//
// function setFavor(){
//
//     let title=document.getElementsByClassName('size');
//     let author=document.getElementsByClassName('size2');
//     let description=document.getElementById('description');
//
//     let content=document.getElementsByTagName('td');
//
//      let image = document.getElementById('con_pic');
//     image.setAttribute('src', '../upfile/' + mpath);
//
//     title[0].innerText = decodeURI(mtitle);
//     //title[1].innerText=mfavorNum;
//     description.lastElementChild.innerText=decodeURI(mdescription);
//     content[0].innerText='Content : '+mcontent;
//     if(mcountry!='') {
//         content[1].innerText = 'Country : ' + decodeURI(mcountry);
//     }
//     if(mcity!='')
//     content[2].innerText='City : '+decodeURI(mcity);
//     if(mauthor!='')
//         author[0].innerText='taken by : '+mauthor; //用户名规定只能为英文字母
//
//
//
//
//     let notlike= document.getElementById('like');
//
//     if(mfavored!=false){
//         notlike.style.color="red";
//         notlike.setAttribute('href','../php/detailCancelFavored.php?path='+mpath+'&title='+mtitle+'&description='+mdescription+'&country='+mcountry+'&city='+mcity+'&content='+mcontent+'&author='+mauthor+'&favored='+mfavorNum);
//         notlike.onclick = function () {
//             alert('若已登陆马上取消收藏，若未登录跳转到登录界面，请登录后操作...');
//         }
//     }
//     else{
//         notlike.style.color="white";
//         notlike.setAttribute('href','../php/setFavored.php?path='+mpath+'&title='+mtitle+'&description='+mdescription+'&country='+mcountry+'&city='+mcity+'&content='+mcontent+'&author='+mauthor+'&favored='+mfavorNum);
//         notlike.onclick = function () {
//             alert('若已登陆马上收藏，若未登录跳转到登录界面，请登录后操作...');
//         }
//     }


    // notlike.onclick = function () {
    //         if(i++%2==0){
    //             notlike.style.color="red";
    //             notlike.setAttribute('href','../php/setFavored.php?path='+mpath+'&title='+mtitle+'&description='+mdescription+'&country='+mcountry+'&city='+mcity+'&content='+mcontent+'&author='+mauthor+'&favored='+mfavorNum);
    //             alert('已收藏');}
    //         else{
    //             notlike.style.color="white";
    //             notlike.setAttribute('href','../php/detailCancelFavored.php?path='+mpath+'&title='+mtitle+'&description='+mdescription+'&country='+mcountry+'&city='+mcity+'&content='+mcontent+'&author='+mauthor+'&favored='+mfavorNum);
    //             alert('已取消收藏');}
    //     }



//}