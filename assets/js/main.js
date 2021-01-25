$(document).ready(function(){
     $('#phone').on('paste', function() {
       return false;
     })
   $('#phone').on('keyup', function(){  
        setPhoneNumber(this)
    })
   $('.iti--allow-dropdown').on('click focus', function(){
        setPhoneNumber($('#phone'))
   })
})

function ajaxPost(formData, callBackFn, saveBtnID) {
    if (saveBtnID != undefined) {
        $("#" + saveBtnID).attr('disabled', true);
    }
    $.ajax({
        type: 'POST',
        url: 'fn.auth.api.php',
        data: {
            appendData: formData
        },
        beforeSend: function() {
            $('.preloader').show()
        },
        success: function(data, status) {
            $('.preloader').hide()
            if (saveBtnID != undefined) {
                $("#" + saveBtnID).attr('disabled', false);
            }
            if (callBackFn != undefined) {
                callBackFn(data);
            }
        },
        error: function(request, status, error) {
            $('.preloader').hide()
            alert(request.responseText);
        }
    });
}


function getDepartmentForSelect(data) {
    resetAllSelect();
    if (data == undefined) {
        ajaxPost("getDept", getDepartmentForSelect);
    } else {
            var data = JSON.parse(data);
            var html = "<option value='0'>Select Department</option>";
            for (var i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
            }
            $("#deptID").html(html);
    }

}

function getDocListForSelect(data) {
    if (data == undefined) {
        if ($('#deptID').val() != 0) {
            var formData = 'getDoct?deptID=' + $('#deptID').val();
            ajaxPost(formData, getDocListForSelect);
        }
    } else {
        var data = JSON.parse(data);
        var html = "<option value='0'>Select Doctor</option>";
        for (var i = 0; i < data.length; i++) {
            html += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
        }
        $("#doctorID").prop("disabled", false)
        $("#doctorID").html(html);
    }
}


function getFreeSlotesForAppointment(data) {

    if (data == undefined) {
        if ($("#doctorID").val() != 0 && $("#appointmentDate").val() != "") {
            var aptDate = $("#appointmentDate").val();


            var formData = 'getFreeSlots?docID=' + $("#doctorID").val() + '&date=' + moment(aptDate).format('DD-MM-YYYY');
            ajaxPost(formData, getFreeSlotesForAppointment);
        }
    } else {

        var data = JSON.parse(data);
        var html = "";
        for (var i = 0; i < data.length; i++) {
            html += "<option data-slotid='" + data[i].slotID + "' value='" + data[i].slotNo + "'>" + data[i].from + (data[i].to == "" ? "" : " - " + data[i].to) + "</option>";
        }
        $("#freeSlotID").prop("disabled", false);
        $("#freeSlotID").html(html);

    }
}
function resendOTP(regid){
    if(regid != '' || regid != undefined){


    }
}
function showTab(name){
    $('.form-tabs .tab').removeClass('active');
    $('.form-tabs').find(`[data-attr='${name}']`).addClass('active');

}

function validateForm(id) {
    var isValid = true;
    $('#'+ id + ' .form-control' ).removeClass('invalid');

    $('#' + id + ' select').each(function() {
        if ($(this).attr("required")) {
            if ($(this).val() == 0 || $(this).val() == null || $(this).val() == undefined || $(this).val() == "") {
                $(this).addClass('invalid')
                // $(this).next().tooltip({ title: "This field required", placement: "top" });
                // $(this).next().tooltip('show');
                isValid = false;
            }
        }
    });
    $('#' + id + ' input').each(function() {       
        if($(this).attr('data-mand')){         
            if ($(this).val().trim() == "") {
                $(this).addClass('invalid')
                 if($(this).is(":hidden")){
                    var rel = $(this).attr("rel");
                    $('#' + rel).addClass('invalid')
                }
                isValid = false;
            }
    }
    });
    $('#' + id + ' textarea').each(function() {
        if ($(this).val().trim() == "") {
            $(this).addClass('invalid')
            isValid = false;
        }
    });
    $('#' + id + ' file').each(function() {

        if ($(this).val() == "") {
            $(this).addClass('invalid')
            isValid = false;
        }
    });
    return isValid;
}
function resetAllSelect() {
    $('#doctorID, #freeSlotID').prop('selectedIndex', 0);
}

function resetFields(form) {
    $('.' + form + ' :input').val('');

}


function isEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
function isNumber(e){
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
         return false;
    }
}
function isPhone(num){
    var isValid = true;
    if(num.length < 11){
        isValid = false; 
    }
    return isValid;
}
function customNotify(formId, message, type){
    $('html, body').animate({scrollTop: 0}, '2000');
    $('#'+ formId +' .response-message').removeClass().addClass('response-message '+ type).html(message);
}

function disableButton(id, type){
    if(type == "a"){
        $("#" + id).addClass('disabled');
    }else{
         $("#" + id).prop('disabled', true);
    }
     $("#" + id).html(`<span class="spinner-border spinner-border-sm mr-3 mb-1" role="status" aria-hidden="true"></span>Loading...`)
}

function enableButton(id, type, message){
    if(type == "a"){
        $("#" + id).removeClass('disabled');
    }else{
         $("#" + id).prop('disabled', false);
    }
     $("#" + id).html(message)
}

function alertModal(title, body, link, linkText){
    $('.alert-modal').modal('show').find('.modal-body').html(`<div class="success-cont">
                            <i class="fas fa-check"></i>
                            <h3>${title}</h3>
                            <p>${body}</p>
                           ${link != '' ? `<a href="${link}" class="btn btn-primary view-inv-btn mt-5">${linkText}</a>` : ''} 
                        </div>`);
    
}


function setPhoneNumber(thiss){
    $("input[name = 'mobileNo']").val('');
        if($(thiss).val() != ''){                    
            var full_number = $('.iti__selected-dial-code').text();
            $("input[name = 'mobileNo']").val(full_number + $(thiss).val()) 
        }
}