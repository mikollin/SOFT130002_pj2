/*
let id = document.getElementById("id");
let email = document.getElementById("email");
let password1 = document.getElementById("password1");
let password2 = document.getElementById("password2");
let submit = document.getElementById("submit");
let form=document.getElementsByName("to_register");
//submit.addEventListener('click',validate_form(form));

function validate_email()
{
    let myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    if(!myreg.test(email.value)) {
        alert('请输入有效的邮箱！');
        email.focus();
        return false;
    }
    else{return true;}
}

function checkPassword(){
        let pattern=/^[0-9a-zA-Z_]/;
        if(!pattern.test(password1.value)){
            alert("密码只能由数字、大小写英文字母和下划线组成")
            return false;
        }
        if(password1.value.length<9){

        }

        if(password1.value!=password2.value)
        {
            alert("密码不一致")
            password1.value = "";
            password2.value = "";
            password1.focus();
            password2.focus();
            return false;
        }
        else {
            return true;
        }

}

function checkUsername(){
    let userReg=/^[0-9a-zA-Z]*$/;
    if(userReg!=""&&!userReg.test(id.value)){
        alert("只能输入是字母与数字,请重新输入");
        id.focus();
        return false;
    }
    else{return true;}
}

function validate_form()
{

        let vr=validate_email();
        let cr=checkPassword();
        let ur=checkUsername();

        return vr&&cr&&ur;

}
*/

$(function () {
    $('form').bootstrapValidator({
        message: 'This value is not valid',
        //live: 'enabled', //验证时机，enabled是内容有变化就验证（默认）
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id: {
                message: '用户名验证失败',
                verbose: false, //代表验证按顺序验证。验证成功才会下一个（验证成功才会发最后一个remote远程验证）
                validators: {
                    notEmpty: {
                        message: '用户名不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: '用户名只能包含大写、小写英文字母、数字'
                    },
                    remote: { //ajax验证。server result:{"valid",true or false} （返回前台类型）
                        //url: "../php/test.php",
                        url:"../php/usernameRegistered.php",
                        //url:'../php/register.php',
                        message: '用户名已存在,请重新输入',
                        delay: 500, //ajax刷新的时间是0.5秒一次
                        type: 'POST',
                        //自定义提交数据，默认值提交当前input value
                         data: function(validator) {
                            return {
                                id: $("input[name=id]").val(),
                            };
                        }

                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: '邮箱地址不能为空'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/,
                        message: '邮箱格式错误'
                    }
                }
            },
            password1: {
                message: '密码验证失败',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: '密码只能包含大写、小写英文字母、数字和下划线'
                    },
                    stringLength: {
                        min: 8,
                        max: 18,
                        message: '弱密码！请保证在8到18位之间'
                    },
                    identical: {
                        field: 'password2',
                        message: '用户新密码与确认密码不一致！请修改！'
                    }
                }
            },
            password2: {
                message: '密码验证失败',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: '密码只能包含大写、小写英文字母、数字和下划线'
                    },
                    stringLength: {
                        min: 8,
                        max: 18,
                        message: '弱密码！请保证在8到18位之间'
                    },
                    identical: {
                        field: 'password1',
                        message: '密码不一致！'
                       }
                }
            }
        }
    });



//$('#to_register').data("bootstrapValidator").validate();
//let bootstrapValidator=$('#to_register').data('bootstrapValidator');
//bootstrapValidator.on('success.form.bv', function(e) {
   // e.preventDefault();
    let data=$('#to_register').serialize();
//序列化获得表单数据，结果为：user_id=12&user_name=John&user_age=20
//？？？不知道为啥用ajax提交的是空数据？？？
    let submitData=decodeURIComponent(data,true);
//submitData是解码后的表单数据，结果同上

    // $('#register_submit').click(function() {
    //     $.ajax({
    //         type: 'POST',
    //         url: '../php/register.php',
    //         data: submitData,
    //         dataType: 'json',
    //         cache: false,//false是不缓存，true为缓存
    //         async: true,//true为异步，false为同步  //解决自动提交问题
    //         beforeSend: function () {
    //             //请求前
    //         },
    //         success: function () {
    //             alert("successful registration");
    //             console.log(data) //服务端返回的数据
    //             // if (data == 1) { //通过返回的数据来判断并且做出相应的行为
    //             //     $(".deom").html("用户名已经存在").css({
    //             //         color: "red"
    //             //     })
    //             // } else {
    //             //     $(".deom").html("用户名可以使用").css({
    //             //         color: "green"
    //             //     })
    //             // }
    //
    //         },
    //         /* complete:function(){
    //              //请求结束时
    //          },*/
    //         error: function () {
    //             alert("registration error");
    //         }
    //     })
    //
    //     //序列化中文以及字符时会出现乱码，是因为.serialize()调用了encodeURLComponent方法将数据编码了
    //     // 解决方法：调用decodeURIComponent(XXX,true);将数据解码
    //
    // })
});