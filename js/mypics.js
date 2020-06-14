let del=document.getElementsByClassName('delete');
//alert(del.length);

let pics=new Array(del.length);
let i=0;
for(;i<del.length;i++) {
    //alert(del[i].getAttribute('name'));
    pics[i] = {"image":del[i].getAttribute('name')};
    del[i].addEventListener('click', function () {
        let j=i;
        $.ajax({
            type: 'POST',
            url: '../php/deletePic.php',
            data: {"image":del[j].getAttribute('name')},
            dataType:'json',
            //contentType:"application/json;charset=utf-8",
            cache: false,//false是不缓存，true为缓存
            async: false,//true为异步，false为同步  //解决自动提交问题
            beforeSend: function () {
                //请求前
            },
            success: function () {


                alert('success');
            },
            complete: function () {
                //请求结束时
            },

            error: function () {
                alert("delete error");
            }
        })
    });
}
