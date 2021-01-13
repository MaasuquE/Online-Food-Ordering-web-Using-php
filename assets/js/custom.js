$('.product-img img').hover(function(){
    $('.fr__hover__info').css('display','block')
});
//Email validatoin//
function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
}


function update_qty(did){
    var qty = $('#qty').val();
    var type="update_qty";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data:{did:did,qty:qty,type:type},
        success:function(result){
            if(result=='done'){
                location.reload();
            }
            if(result=='failed'){
                alert('Something went wrong');
            }
        }
    });
}

function set_checkbox(id){
    var k = $("input[type='checkbox']:checked").val();
    var type="cat_chk";
    if(k !=''){
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{cat_id:k,type:type},
            success:function(result){
                jQuery('#cat_chk').html(result);
            }
        });
    }
}

$('#email').focus(function (){
    if($(this).val()==''){
        $('.email_error').html('Enter a valid Email');
    }else{
        if(validateEmail($(this).val())){
            $('.email_error').html('Email is  valid');
        }
        else{
            $('.email_error').html('Email is not valid');
        }
    }
}).blur(function (){
    $('.email_error').html('');
}).keyup(function (){
    if($(this).val()!=''){
        if(validateEmail($(this).val())){
            $('.email_error').html('Email is  valid');
        }
        else{
            $('.email_error').html('Email is not valid');
        }
    }
    else{
        $('.email_error').html('Enter a valid email');
    }
});
////----Email Varification------/////

$('.tab-pane #email').keyup(function(){
    var email =$('.tab-pane #email').val();
    if(validateEmail(email)){
        $('.tab-pane #email').css('width','83%');
        $('.tab-pane #s_otp').show();
    }
});

function send_otp(){
    $('.tab-pane #email').css('width','54%');
    
    
    $('.tab-pane #email').attr('disabled','disabled');
    var email = $('.tab-pane #email').val();
    var type = "send_otp";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data:{type:type,email:email},
        success:function(result){
            if(result=='done'){
                $('.tab-pane #otp').show();
                $('.tab-pane #s_otp').html('Verify').show();
            }
            alert(result);
        }
    });
}

////-------Register Section--------//////
function register(){
    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var type = "register_submit";
    var is_error = "";
    if(name==""){
        jQuery('.name_error').html("Name is blank.");
        is_error='yes';
    }
    if(email==""){
        jQuery('.email_error').html("email is blank.");
        is_error='yes';
    }
    if(!validateEmail(email)){
        jQuery('.email_error').html("Email is Invalid.");
        is_error='yes';
    }
    if(mobile==""){
        jQuery('.mobile_error').html("mobile is blank.");
        is_error='yes';
    }
    if(password==""){
        jQuery('.password_error').html("password is blank.");
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{name:name,email:email,mobile:mobile,password:password,type:type},
            success:function(result){
                if(result=="done"){
                    location.href="login-register.php";
                }
            }
        });
    }
    
}

function login(page){
    var email=$('#login_email').val();
    var password=$('#login_password').val();
    var type="login";
    is_error="";
    if(email==""){
        jQuery('.email_error').html("Email is blank.");
        is_error='yes';
    }
    if(!validateEmail(email)){
        jQuery('.email_error').html("Email is Invalid.");
        is_error='yes';
    }
    if(password==""){
        jQuery('.password_error').html("password is blank.");
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{email:email,pass:password,page:page,type:type},
            success:function(result){
                if(result=="login"){
                    location.href="index.php";
                }
                else if(result=='checkout'){
                    jQuery('#payment-1').hide(1000);
                    jQuery('#payment-2').show(1000);

                }
                else if(result=='failed'){
                    jQuery('.login_failed').html('Data Error');
                }
            }
        });
    }
    
}



function checkout_done(sub_total){
    var f_name=$('#f_name').val();
    var l_name=$('#l_name').val();
    var name = f_name+" "+l_name;
    var email=$('#email').val();
    var city=$('#city').val();
    var postal_code=$('#postal_code').val();
    var country=$('#country').val();
    var address=city+"-"+postal_code+", "+country;
    var mobile=$('#mobile').val();
    var payment_type = $("input[type='radio'][name='payment']:checked").val();
    var type = "checked_done";
    is_error="";
    if(f_name==""){
        jQuery('.f_name').html("First name is blank.");
        is_error='yes';
    }
    if(l_name==""){
        jQuery('.l_name').html("Last name is blank.");
        is_error='yes';
    }
    if(email==""){
        jQuery('.email').html("Email is blank.");
        is_error='yes';
    }
    if(city==""){
        jQuery('.city').html("City is blank.");
        is_error='yes';
    }
    if(postal_code==""){
        jQuery('.postal_code').html("Postal code is blank.");
        is_error='yes';
    }
    if(country==""){
        jQuery('.country').html("Country is blank.");
        is_error='yes';
    }
    if(payment_type==""){
        jQuery('.payment').html("Payment type is blank.");
        is_error='yes';
    }
    if(mobile==""){
        jQuery('.mobile').html("Mobile is blank.");
        is_error='yes';
    }
    if(is_error==""){
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{name:name,email:email,address:address,mobile:mobile,payment_type:payment_type,sub_total:sub_total,type:type},
            success:function(result){
                if(result=='done'){
                    location.href='order.php';
                }
                // console.log(result);
            }
        });
    }
}
$('#payment-2 input').focusin(function (){
    $('#payment-2 #field_error').html('');
});
jQuery('.header-cart').click(function (){
    location.href='cart.php';
});
jQuery('#header_wishlist').click(function (){
    location.href='wishlist.php';
});



function dboy_submit(){
    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var type = "dboy_submit";
    var is_error = "";
    if(name==""){
        jQuery('.name_error').html("Name is blank.");
        is_error='yes';
    }
    if(email==""){
        jQuery('.email_error').html("email is blank.");
        is_error='yes';
    }
    if(!validateEmail(email)){
        jQuery('.email_error').html("Email is Invalid.");
        is_error='yes';
    }
    if(mobile==""){
        jQuery('.mobile_error').html("mobile is blank.");
        is_error='yes';
    }
    if(password==""){
        jQuery('.password_error').html("password is blank.");
        is_error='yes';
    }
    if(is_error==''){
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{name:name,email:email,mobile:mobile,password:password,type:type},
            success:function(result){
                if(result=="done"){
                    location.href="index.php";
                }
            }
        });
    }
    
}
jQuery('.deliver_container input').blur(function () {
    jQuery(this).removeProperty("box-shadow");
});

jQuery('.deliver_container input').focus(function (){
        jQuery(this).css('box-shadow','1px 2px 10px');
}).blur(function () {
    var inp = jQuery('.deliver_container input').val();
    if(inp==''){
        alert('ok');
        jQuery('.deliver_container input').removeProperty('box-shadow');
    }
});

function file_change(uid){
    var fd = new FormData();
    var files = $('#file')[0].files;
    
    // Check file selected or not
    if(files.length > 0 ){
       fd.append('file',files[0]);

       $.ajax({
          url: 'upload_profile.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response != 0){
                $("#img").attr("src",response); 
                $(".preview img").show(); // Display image element
             }else{
                alert('file not uploaded');
             }
          },
       });
    }else{
       alert("Please select a file.");
    }
 }
 $('.category_list .active').val('');
$('.sub_cat').click(function (){
    var val = $(".sub_cat:checked").val();
    var cat = $('.category_list .active input').val();
    if(typeof(cat)=='undefined'){
        cat='';
    }
    var type="sub_cat";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data:{val:val,type:type,cat:cat},
        success:function(result){
            $('#cat_chk').html(result);
            // alert(result);
        }
    });
});


function change_pass(){
    $('#change_pass').show();
}


function update_profile(id,img){
    $('.field_error').html('');
    var name=$('#name').val();
    var email=$('#email').val();
    var phn=$('#phn').val();
    var new_pass1=$('#new_pass1').val();
    var new_pass2=$('#new_pass2').val();
    var display =$('#new_pass_chk').css('display');
    var pass ='';
    var is_error ='';
    if(display!='none'){
        if(new_pass1!='' && new_pass2!=''){
        
            if((new_pass1.length<6 && new_pass2.length<6)){
                $('#pass2_error').html('Password should be more than 6');
                is_error='yes';
            }
            else if(new_pass1 == new_pass2){
                 pass=new_pass1;
                is_error='';
            }
            else{
                $('#pass2_error').html('Password does not match');
                is_error='yes';
            }
        }
        else{
            if(new_pass1==''){
                $('#pass1_error').html('Password is required');
                is_error='yes';
            }
            if(new_pass1==''){
                $('#pass2_error').html('Password is required');
                is_error='yes';
            }
        }
    }
    if(!validateEmail(email)){
        $('#email_error').html('Email is invalid');
        is_error='yes';
    }
     if(is_error==''){
        var type="update_profile";
        jQuery.ajax({
            url:'update_data.php',
            type:'post',
            data:{id:id,name:name,email:email,phn:phn,img:img,pass:pass,type:type},
            success:function(result){
                if(result=="done"){
                    location.href='profile.php';
                }
                if(result=='email_ex'){
                    $('#email_error').html('Email already exits.');
                }
                if(result=='phn_ex'){
                    $('#phn_error').html('Phone number already exits.');
                }
                if(result=='both_ex'){
                    $('#email_error').html('Email already exits.');
                    $('#phn_error').html('Phone number already exits.');
                }
            }
        });
     }
    
}
function pass_check(pass,id){
    if(pass!='' && id!= ''){
        var type="pass_check";
        return $.ajax({
            url:'update_data.php',
            type:'post',
            data:{type:type,pass:pass,id:id},
            
        });
    }
    
}

$('#old_pass').keyup(function (){
    $('#old_error').html('');
    var pass = $(this).val();
    var id =$('#pass_chk_id').val();
    if(pass!=''){
        var data =(pass_check(pass,id));
        data.success(function(result){
            if(result=='checked'){
                    $('#old_error').html('Password Matched');
                    $('#new_pass_chk').show();
                }
                else{
                    $('#old_error').html('Password not Matched');
                    $('#new_pass_chk').hide();
                }   
        });
    }
});


$(".cmt_input span").click(function(){
    var cmt=$("#cmt_inp").val();
    var dish_id = $('#pid').val();
    var type="comment";
    if(cmt!=''){
        $.ajax({
            url:'update_data.php',
            type:'post',
            data:{type:type,cmt:cmt,dish_id:dish_id},
            success:function(result){
                if(result=="done"){
                    location.reload();
                    
                }
                if(result=='no login'){
                    location.href='login-register.php';
                }
            }
        });
    }
    
})

function reply(){
    
    $('.reply_input ').show();
    
}

$(".cmt_reply span").click(function(){
    var cmt=$("#cmt_inp").val();
    var dish_id = $('#pid').val();
    var type="comment";
    if(cmt!=''){
        $.ajax({
            url:'update_data.php',
            type:'post',
            data:{type:type,cmt:cmt,dish_id:dish_id},
            success:function(result){
                if(result=="done"){
                    location.reload();
                }
                if(result=='no login'){
                    location.href='login-register.php';
                }
            }
        });
    }
   
})

function reply_cmt(cmt_id,user_id){
    var reply=$('#reply_inp').val();
    var type="reply";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data:{cmt_id:cmt_id,user_id:user_id,reply:reply,type:type},
        success:function(result){
            if(result=="done"){
                location.reload();
            }
        }
    });
}

$('.comment').click(function(){
    $('.comment_show').show();
    $('.comment').css('color','rgb(231, 160, 5)');
    $('.review_show').hide();
    $('.review').css('color','bisque');
});
$('.review').click(function(){
    $('.review_show').show();
    $('.review').css('color','rgb(231, 160, 5)');
    $('.comment_show').hide();
    $('.comment').css('color','bisque');
});
$('.search_box input').keyup(function(){
    var search=$(this).val();
    var type="search_box";
    $.ajax({
        url:'update_data.php',
        type:'post',
        data:{type:type,search:search},
        success:function(result){
            if(result==''){
                $('#cat_chk').html('<h4>Data Not Found</h4>');
                $('#cat_chk h4').css({
                    'color':'red',
                    'margin-left':'40%'
                });
            }else{
                $('#cat_chk').html(result);
            }
            
        }
    });
    
});

$('#send_message').click(function(){
    var name=$('#name').val();
    var email=$('#email').val();
    var mobile=$('#mobile').val();
    var subject=$('#subject').val();
    var message=$('#message').val();
    var type="send_message";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data:{name:name,email:email,mobile:mobile,subject:subject,message:message,type:type},
        success:function(result){
            if(result=="done"){
                // location.reload(3000);
                $('.form-messege').html("Thank you for connecting with us, will get back to you shortly");
                $('#contact-form input,#contact-form textarea').val('');
            }
        }
    });
});


//////-----Rating Section---///

$('.rate label').click(function(){
    var rate=$(this).text();
    var pid=$('#rating_hidden').val();
    var type="rating";
    jQuery.ajax({
        url:'update_data.php',
        type:'post',
        data: {rate:rate,pid:pid,type:type},
        success:function(result){
            if(result=="done"){
                
            }
        }
    });
});