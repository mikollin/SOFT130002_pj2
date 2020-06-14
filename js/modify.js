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

let mpath=getQueryVariable('path');

let mtitle=getQueryVariable('title');
let mdescription=getQueryVariable('description');
let mcontent=getQueryVariable('content');

if(mpath!=false&&mtitle!=false&&mdescription!=false&&mcontent!=false)
    modify();



//let filepath='../upfile/'+path;
//let file = new File(,)
function modify() {
    let up_button=document.getElementById("up_button");
    let title=document.getElementsByName('upload_pic_title');
    let description=document.getElementsByName('upload_pic_description');
    let country=document.getElementById('first');
    let city=document.getElementById('second');
    let content=document.getElementsByName('upload_pic_theme')[0];

    document.getElementById("up_line").style.display = "none";
    let image = document.getElementById('ready_to_up_pics');
    image.setAttribute('src', '../upfile/' + mpath);
    up_button.required = false; //设置选择文件不一定要选
    title[0].value = decodeURI(mtitle);
    //encodeURI(title[0].value);

    description[0].value = decodeURI(mdescription); //decode
    //encodeURI(description[0].value);
//     switch (mcountry) {
//         case 'China':
//             country.options[1].selected = true;
//             break;
//         case 'Japan':
//             country.options[2].selected = true;
//             break;
//         case 'Italy':
//             country.options[3].selected = true;
//             break;
//         case 'America':
//             country.options[4].selected = true;
//             break;
//     }
//
// //city.options.add(new Option("Shanghai", "Shanghai"));
//
//     function change() {
//
//         var x = document.getElementById("first");
//
//         var y = document.getElementById("second");
//
//         y.options.length = 0; // 清除second下拉框的所有内容
//
//         if (x.selectedIndex == 1) {
//
//             y.options.add(new Option("Shanghai", "Shanghai"));
//             y.options.add(new Option("Kunming", "Kunming"));
//             y.options.add(new Option("Beijing", "Beijing", false, true));  // 默认选中首都  第一个TRUE是(默认被选项，即焦点的在项，只有一个)
//             //defaultselected，相当于<option selected></option>第二个TRUE是被选择项（可多行被选择），用于multiple模式
//             y.options.add(new Option("Yantai", "Yantai"));
//
//         }
//
//
//         if (x.selectedIndex == 2) {
//
//
//             y.options.add(new Option("Tokyo", "Tokyo", false, true));  //  默认选中首都
//             y.options.add(new Option("Osaka", "Osaka"));
//             y.options.add(new Option("Kamakura", "Kamakura"));
//
//
//         }
//
//         if (x.selectedIndex == 3) {
//
//
//             y.options.add(new Option("Roma", "Roma", false, true));  //  默认选中首都
//             y.options.add(new Option("Milan", "Milan"));
//             y.options.add(new Option("Venice", "Venice"));
//             y.options.add(new Option("Florence", "Florence"));
//
//
//         }
//
//         if (x.selectedIndex == 4) {
//
//
//             y.options.add(new Option("New York", "New York", false, true));  //  默认选中首都
//             y.options.add(new Option("San Francisco", "San Francisco"));
//             y.options.add(new Option("Washington", "Washington"));
//
//
//         }
//
//
//     }
//
//     change();
//     if (country.selectedIndex == 1) {
//         switch (mcity) {
//             case 'Shanghai':
//                 city.options[0].selected = true;
//                 break;
//             case 'Kunming':
//                 city.options[1].selected = true;
//                 break;
//             case 'Beijing':
//                 city.options[2].selected = true;
//                 break;
//             case 'Yantai':
//                 city.options[3].selected = true;
//                 break;
//
//         }
//     } else if (country.selectedIndex == 2) {
//         switch (mcity) {
//             case 'Tokyo':
//                 city.options[0].selected = true;
//                 break;
//             case 'Osaka':
//                 city.options[1].selected = true;
//                 break;
//             case 'Kamakura':
//                 city.options[2].selected = true;
//                 break;
//
//         }
//     } else if (country.selectedIndex == 3) {
//         switch (mcity) {
//             case 'Roma':
//                 city.options[0].selected = true;
//                 break;
//             case 'Milan':
//                 city.options[1].selected = true;
//                 break;
//             case 'Venice':
//                 city.options[2].selected = true;
//                 break;
//             case 'Florence':
//                 city.options[3].selected = true;
//                 break;
//
//         }
//     } else if (country.selectedIndex == 4) {
//         switch (mcity) {
//             case 'New York':
//                 city.options[0].selected = true;
//                 break;
//             case 'San Francisco':
//                 city.options[1].selected = true;
//                 break;
//             case 'Washington':
//                 city.options[2].selected = true;
//                 break;
//
//         }
//     }
//
    switch (mcontent) {
        case 'Building':
            content.options[1].selected = true;
            break;
        case 'Wonder':
            content.options[2].selected = true;
            break;
        case 'Scenery':
            content.options[3].selected = true;
            break;
        case 'City':
            content.options[4].selected = true;
            break;
        case 'People':
            content.options[5].selected = true;
            break;
        case 'Animal':
            content.options[6].selected = true;
            break;
        case 'Other':
            content.options[7].selected = true;
            break;
    }

    let submit=document.getElementById('upload_submit');
    submit.innerHTML='Modify';
    let page=document.getElementsByClassName('up_til')[0];
    page.innerHTML='MODIFY';
    let form=document.getElementsByTagName('form')[0];
    form.setAttribute('action','../php/modify.php?path='+mpath);

}