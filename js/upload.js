

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
            /*id: {
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
                        url:"../php/usernameNotExist.php",
                        //url:'../php/register.php',
                        message: '用户名不存在,请重新输入或前往注册',
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

            password: {
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

                    remote: { //ajax验证。server result:{"valid",true or false} （返回前台类型）

                        url:"../php/passwordCheck.php",
                        message: '用户密码不一致！请修改！',
                        delay: 500, //ajax刷新的时间是0.5秒一次
                        type: 'POST',
                        //自定义提交数据，默认值提交当前input value
                        data: function(validator) {
                            return {
                                id: $("input[name=id]").val(),
                                password:$("input[name=password]").val()
                            };
                        }

                    }
                }


            }



             */
        }
    });


});