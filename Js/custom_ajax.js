$(function() {
    $('#companyloginsubmit').bind('submit', function() {
        var form = new FormData($('#companyloginsubmit')[0]);
        //var token='S7Mys7RSqlbySCtKjQ8LVLJScstJSy+q8iusKks0VNJRck+qKEoEChvmmRYWFhSa55mYmBXnWRYXFBoWmRpZFFla5hXkm+abK9UqWQMA';
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/Company_login',
            // headers: { 'Authorization': token},
            contentType: false,
            processData: false,
            data: form,
            beforeSend: function() {
                $('body').css('z-index', 99999999999);
                $('.overlay').show();
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                if (data.status === true) {
                    window.location.href = BASE_URL + "home/login";
                } else {
                    $('.overlay').hide();
                    $('.err_msg').html('<p class="alert alert-danger">' + data.message + '<p>');
                }
            }

        });
        return false;
    });

});


function saveAsdefalut() {
    var company_id = $('#companycode').val();
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/Defalut_Company_login',
        data: 'companycode=' + company_id,
        beforeSend: function() {
            $('body').css('z-index', 99999999999);
            $('.overlay').show();
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            if (data.status === true) {
                window.location.href = BASE_URL + "home/login";
            } else {
                $('.overlay').hide();
                $('.err_msg').html('<p class="alert alert-danger">' + data.message + '<p>');
            }
        }

    });
    return false;

}



$(function() {
    $('#companyLogin').bind('submit', function() {
        var form = new FormData($('#companyLogin')[0]);
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/Company_Login_Action',
            contentType: false,
            processData: false,
            data: form,
            beforeSend: function() {
                $('body').css('z-index', 99999999999);
                $('.overlay').show();
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                if (data.status === true) {
                    window.location.href = BASE_URL + "Dashboard/welcome";
                } else {
                    $('.overlay').hide();
                    $('.err_msg').html('<p class="alert alert-danger">' + data.message + '<p>');
                }
            }

        });
        return false;
    });

});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function getmenulist(i, j) {
    $('.sucess').html(' ');
    $('#example').html(' ');
    $('#tablecreate').html(' ');
    //$('.content').html(' ');


    var senddata = {
        tablename: i,
        parameter: j
    }
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/listgenerator',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $("#tablecreate").empty().html(data.data);
            } else {
                $('.overlay_msg').hide();
                $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
            }
        }

    });
    return false;

}




function createformenater(i, j) {
    var senddata = {
        tablename: i,
        parameter: j
    }
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createformenater',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
                $("#tablecreate").empty().html(data.data);
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
    return false;

}


$(function() {
    $('#adddata').click(function() {
        var form = new FormData($('#adddata')[0]);
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/adddata',
            contentType: false,
            processData: false,
            data: form,
            beforeSend: function() {
                $('body').css('z-index', 99999999999);
                $('.overlay').show();
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                if (data.status === true) {
                    window.location.href = BASE_URL + "Dashboard/welcome";
                } else {
                    $('.overlay').hide();
                    $('.err_msg').html('<p class="alert alert-danger">' + data.message + '<p>');
                }
            }

        });
        return false;
    });

});

function adddatainsert() {
    $('.alert-danger').remove();

    var form = new FormData($('#adddata')[0]);
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/adddatainsert',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        contentType: false,
        processData: false,
        data: form,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $('.sucess').html('<p class="sucess">' + data.message + '<p>');
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }
                $.each(data.data, function(key, value) {
                    $('input[name="name[' + key + ']"]').closest('div').append('<p class="alert alert-danger">' + value + '</p>');
                });
                $('.overlay_msg').hide();

            }
        }

    });
    return false;

}

function deletedata(i, j, k, l) {
    var confirmation = confirm(' Are you sure you want to delete this List Data ?');

    if (confirmation) {
        var senddata = {
            id: i,
            tablename: j,
            idname: k,
            parameter: l
        }
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/deletedata',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();

                if (data.status === true) {
                    getmenulist(j, l);
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                } else {
                    $('.overlay_msg').hide();
                    /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
                }
            }

        });
        return false;
    }
}

function deletelogicaltabledata(i, j) {
    var confirmation = confirm(' Are you sure you want to delete this List Data ?');

    if (confirmation) {
        var senddata = {
            id: i,
            Field_no: j
        }
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/deletelogicaltabledata',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();

                if (data.status === true) {
                    createtable();
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                } else {
                    $('.overlay_msg').hide();
                    /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
                }
            }

        });
        return false;
    }
}

function createtable() {
    $('#tablecreate').html(' ');

    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createtable',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
                 $('#tablecreate').show();
                $('.sucess').html(data.data);
                     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function checktablenameornot() {
    $('#tablecreate').html(' ');

    var form = new FormData($('#adddata')[0]);
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/checktablenameornot',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        contentType: false,
        processData: false,
        data: form,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {

                $('.sucess').html(data.data);
                $("#sortable1, #sortable2").sortable({
                    disable: true
                });
                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable"
                }).disableSelection();
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }
                $.each(data.data, function(key, value) {
                    $('input[name="name[' + key + ']"]').closest('div').append('<p class="alert alert-danger">' + value + '</p>');
                });
                $('.overlay_msg').hide();

            }
        }

    });
    return false;
}


function add(i) {

    var new_chq_no = parseInt($('#total_chq' + i).val());
    var new_input2 = "<button class='delete_btn' id='remove_" + new_chq_no + "' onclick='remove(" + new_chq_no + ")'><i class='fas fa-times'></i></button>";
    var new_input = "<input type='text' name='datatype' id='tdatatype_" + new_chq_no + "' placeholder='Datatype'>";
    var new_input1 = "<input type='text' name='tlength' id='tlength_" + new_chq_no + "' placeholder='Length'>";
    $('#new_chq' + i).append(new_input);
    $('#new_chq' + i).append(new_input1);
    $('#new_chq' + i).append(new_input2);
    $('#total_chq' + i).val(new_chq_no);
    $("#new_chq" + i).css("display", "block");
    $("#add_" + i).css("display", "none");

}

function remove(j) {

    var last_chq_no = parseInt($('#total_chq' + j).val());
    $('#tdatatype_' + last_chq_no).remove();
    $('#tlength_' + last_chq_no).remove();
    $('#remove_' + last_chq_no).remove();
    $("#new_chq" + last_chq_no).css("display", "none");
    $("#add_" + last_chq_no).css("display", "block");
}

function editupdatelistcong() {

  

    var confirmation = confirm(' Are you sure you want to Create this Table ?');

    if (confirmation) {
    var tablename  = $( "#tablename" ).val();
     var ListConfiguration_ID  = $( "#ListConfiguration_ID" ).val();
    var filednoArray = new Array();
    $("#sortable2 input:hidden[name=tfiledno]").each(function() {
        filednoArray.push($(this).val());
    });  
        var senddata = 'tablename=' + tablename + '&filedname=' + filednoArray+'&ListConfiguration_ID='+ListConfiguration_ID;
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/editListConfiguration',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();
                if (data.status === true) {
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                    $('#tablecreate').hide();
                    createlistconftable();

                } else {
                    $('.overlay_msg').hide();
                    $('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');
                }
            }

        });
        return false;
    }
}
function addlogicalformenater() { 
$('.sucess').html(' ');
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createlogicalformenater',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
                
                $("#tablecreate").empty().html(data.data);
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
    return false;
}

function addlogicaldatainsert() {
    $('.alert-danger').remove();

    var form = new FormData($('#adddata')[0]);
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/addlogicaldatainsert',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        contentType: false,
        processData: false,
        data: form,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $('#tablecreate').html(' ');
                $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                 $("#example").dataTable();
                createtable();
               
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }

                $('.overlay_msg').hide();

            }
        }

    });
    return false;

}

function createlistconftable() {

    $('#tablecreate').html(' ');

    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createlistconftable',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {

                $('.sucess').html(data.data);
                     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function editlistconfigformenater(i) { 
       var senddata = {
            id: i
        }    
$('.sucess').html(' ');
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createlistconfigformenater',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
                
                $(".sucess").empty().html(data.data);
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
    return false;
}

function getvalue(i,j,k,l){
$('.sucess').html(' ');
    var logicaltname = $('#logicaltname').val();
       var senddata = {
            tablename: i,
            id: j,
            Shown_Field:k,
            No_Show_Field:l
        }
    
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/addlistconfigtable',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
              $('#tablecreate').show();
                $('#tablecreate').html(data.data);
                 $("#sortable1, #sortable2").sortable({
                    disable: true
                });
                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable"
                }).disableSelection();     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function editlogicaltabledata(i, j) { 
$('.sucess').html(' ');
   var senddata = {id: i,Field_no: j}
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/editlogicaltabledata',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
                
                $("#tablecreate").empty().html(data.data);
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
    return false;
}

function updatelogicaldatainsert() {
    $('.alert-danger').remove();

    var form = new FormData($('#adddata')[0]);
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/updatelogicaldatainsert',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        contentType: false,
        processData: false,
        data: form,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $('#tablecreate').html(' ');
                $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                 $("#example").dataTable();
                createtable();
               
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }

                $('.overlay_msg').hide();

            }
        }

    });
    return false;

}

function deletelistconfigdata(i) {
    var confirmation = confirm(' Are you sure you want to delete this List Data ?');

    if (confirmation) {
        var senddata = {
            id: i
        }
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/deletelistconfigdata',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();

                if (data.status === true) {
                   createlistconftable();
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                } else {
                    $('.overlay_msg').hide();
                    /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
                }
            }

        });
        return false;
    }
}


function addlistconfigformenater() {

    $('#tablecreate').html(' ');

    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createlistconfigformenater',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {

                $('.sucess').html(data.data);
                     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}



function gettablevalue(){

    var logicaltname = $('#logicaltname').val();
       var senddata = {
            tablename: logicaltname
        }
    
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/getlistconfigtablevalue',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
              $('#tablecreate').show();
                $('#tablecreate').html(data.data);
                 $("#sortable1, #sortable2").sortable({
                    disable: true
                });
                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable"
                }).disableSelection();     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function savelistcongtable() {

  

    var confirmation = confirm(' Are you sure you want to Create this Table ?');

    if (confirmation) {
    var language  = $( "#language" ).val();
    var listname  = $( "#listname" ).val();
    var title  = $( "#title" ).val();
    var tablename = $( "#logicaltname option:selected" ).text();
    var filednoArray = new Array();
    $("#sortable2 input:hidden[name=tfiledno]").each(function() {
        filednoArray.push($(this).val());
    });  
        var senddata = 'tablename=' + tablename + '&language=' + language+'&listname='+listname+'&title='+title+'&filednoArray='+filednoArray;
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/savelistcongtable',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                    var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $('#tablecreate').html(' ');
                $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                 $("#example").dataTable();
                createlistconftable();
               
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }

                $('.overlay_msg').hide();

            }
        }

        });
        return false;
    }


}

    function createformconfigtable() {
    

    $('#tablecreate').html(' ');

    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createformconftable',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {

                $('.sucess').html(data.data);
                     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function addformconfigformenater() {

    $('#tablecreate').html(' ');

    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/createformconfigformenater',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {

                $('.sucess').html(data.data);
                     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function getformlogicaltablevalue(){

    var logicaltname = $('#logicaltname').val();
       var senddata = {
            tablename: logicaltname
        }
    
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/getformconfigtablevalue',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
              $('#tablecreate').show();
                $('#tablecreate').html(data.data);
                 $("#sortable1, #sortable2").sortable({
                    disable: true
                });
                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable"
                }).disableSelection();     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}

function saveformcongtable() {

  

    var confirmation = confirm(' Are you sure you want to Create this Table ?');

    if (confirmation) {
    var language  = $( "#language" ).val();
    var listname  = $( "#listname" ).val();
    var title  = $( "#title" ).val();
    var tablename = $( "#logicaltname option:selected" ).text();
    var filednoArray = new Array();
    $("#sortable2 input:hidden[name=tfiledno]").each(function() {
        filednoArray.push($(this).val());
    });  
        var senddata = 'tablename=' + tablename + '&language=' + language+'&listname='+listname+'&title='+title+'&filednoArray='+filednoArray;
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/saveformcongtable',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                    var data = $.parseJSON(response);
            $('.overlay_msg').hide();
            if (data.status === true) {
                $('#tablecreate').html(' ');
                $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                 $("#example").dataTable();
                 createformconfigtable();
               
            } else {
                if (data.message != '') {
                    $('.sucess').empty().html('<p class="alert alert-danger">' + data.message + '<p>');
                }

                $('.overlay_msg').hide();

            }
        }

        });
        return false;
    }


}


function deleteformconfigdata(i) {
    var confirmation = confirm(' Are you sure you want to delete this Form Data ?');

    if (confirmation) {
        var senddata = {
            id: i
        }
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/deleteformconfigdata',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();

                if (data.status === true) {
                   createformconfigtable();
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                } else {
                    $('.overlay_msg').hide();
                    /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
                }
            }

        });
        return false;
    }
}


function getformvalue(i,j,k,l){
$('.sucess').html(' ');
    var logicaltname = $('#logicaltname').val();
       var senddata = {
            tablename: i,
            id: j,
            Shown_Field:k,
            No_Show_Field:l
        }
    
    $.ajax({
        type: 'post',
        url: BASE_URL + 'Ajax/addformconfigtable',
        headers: {
            'X-Requested-With': AUTH_TOKEN
        },
        data: senddata,
        beforeSend: function() {
            var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
            $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
        },
        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            $('.overlay_msg').hide();

            if (data.status === true) {
              $('#tablecreate').show();
                $('#tablecreate').html(data.data);
                 $("#sortable1, #sortable2").sortable({
                    disable: true
                });
                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable"
                }).disableSelection();     
            } else {
                $('.overlay_msg').hide();
                /*$('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');*/
            }
        }

    });
}


function editupdateformcong() {

  

    var confirmation = confirm(' Are you sure you want to Create this Table ?');

    if (confirmation) {
    var tablename  = $( "#tablename" ).val();
     var FormConfiguration_ID  = $( "#FormConfiguration_ID" ).val();
    var filednoArray = new Array();
    $("#sortable2 input:hidden[name=tfiledno]").each(function() {
        filednoArray.push($(this).val());
    });  
        var senddata = 'tablename=' + tablename + '&filedname=' + filednoArray+'&FormConfiguration_ID='+FormConfiguration_ID;
        $.ajax({
            type: 'post',
            url: BASE_URL + 'Ajax/editFormConfiguration',
            headers: {
                'X-Requested-With': AUTH_TOKEN
            },
            data: senddata,
            beforeSend: function() {
                var img_url = BASE_URL + 'assets/images/loading-gif-png-5.gif';
                $('body').append('<div class="overlay_msg"><img src=' + img_url + ' /></div>');
            },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                $('.overlay_msg').hide();
                if (data.status === true) {
                    $('.sucess').html('<p class="sucess">' + data.message + '<p>');
                    $('#tablecreate').hide();
                    createformconfigtable();

                } else {
                    $('.overlay_msg').hide();
                    $('.err_msg').empty().html('<p class="alert alert-danger">'+data.message+'<p>');
                }
            }

        });
        return false;
    }
}