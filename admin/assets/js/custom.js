function login_btn(){
    var email=jQuery('#exampleInputEmail1').val();
    var password=jQuery('#exampleInputPassword1').val();
    var type="submit";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{email:email,password:password,term:type},
        success:function(result){
            if(result == 'done'){
                
                location.href='index.php';
            }
        }
    });
}

jQuery('#logout-btn').click(function(){ 
    var type="logout";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{term:type},
        success:function(result){
            if(result == 'done'){
                location.href='login.php';
            }
        }

    });
});
jQuery('.field_error').html('');
$('#btn').click(function (){
    var category=jQuery('#category').val();
    var type="insert";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{category:category,term:type},
        success:function(result){
            if(result == 'exist'){
                jQuery('#category_error').html('Category already exist.');
            }
            if(result == 'done'){
                location.href='category.php';
            }
            if(result=='failed'){
                jQuery('#failed_error').html('Somethig wrong! please try after sometime.');
            }
        }
    });
});


function edit_category(cid){
    var category=jQuery('#category').val();
    var type="edit";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{category:category,cid:cid,term:type},
        success:function(result){
            if(result == 'exist'){
                jQuery('#category_error').html('Category already exist.');
            }
            if(result == 'done'){
                location.href='category.php';
            }
            if(result=='failed'){
                jQuery('#failed_error').html('Somethig wrong! please try after sometime.');
            }
        }
    });
}

function sts_btn(cid,sts){
    var type="status_change";

        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Deactive');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('active');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
            }
        });
}



function admin_sts_btn(cid,sts){
    var type="admin_status_change";

        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Normal');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('Admin');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
            }
        });
}


function edit_admin(cid){
    var name=jQuery('#name').val();
    var username=jQuery('#username').val();
    var password=jQuery('#password').val();
    var sts =jQuery('#status').val();
    var type="admin_edit";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{name:name,cid:cid,username:username,sts:sts,password:password,term:type},
        success:function(result){
            if(result == 'exist'){
                jQuery('#category_error').html('Username already exist.');
            }
            if(result == 'done'){
                location.href='admin_user.php';
            }
            if(result=='failed'){
                jQuery('#failed_error').html('Somethig wrong! please try after sometime.');
            }
        }
    });
}


$('#add_user_btn').click(function (){
    var name=jQuery('#name').val();
    var username=jQuery('#username').val();
    var email=jQuery('#email').val();
    var password=jQuery('#password').val();
    var sts=jQuery('#status').val();
    var type="admin_insert";
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{name:name,username:username,email:email,password:password,sts:sts,term:type},
        success:function(result){
            if(result == 'exist'){
                jQuery('#failed_error').html('username or email already exist.');
                
            }
            if(result == 'done'){
                location.href='admin_user.php';
            }
            if(result=='failed'){
                jQuery('#failed_error').html('Somethig wrong! please try after sometime.');
            }
        }
    });
});


function admin_dlt_btn(cid){
    var type="admin_delete";
    
    jQuery.ajax({
        url:'admin_data.php',
        type:'post',
        data:{cid:cid,term:type},
        success:(function(result){
            if(result == 'done'){
                location.reload();
            }
        })
    });
}



function user_sts_btn(cid,sts){
    var type="user_status_change";

        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Deactive');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('active');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
            }
        });
}

function dboy_sts_btn(cid,sts){
    var type="dboy_status_change";

        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Deactive');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('active');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
            }
        });
}


function dish_sts_btn(cid,sts){
    var type="dish_status_change";

        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Deactive');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('active');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
                
            }
        });
}


function upload_img(){
    var fd = new FormData();
    var files = $('#image')[0].files;
    

    // Check file selected or not
    if(files.length > 0 ){
       fd.append('file',files[0]);
       $.ajax({
          url: 'upload_img.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
              $('.up_img img').attr('src',response);
          },
       });
    }else{
       alert("Please select a file.");
    }
}

$('#add_dish_btn').click(function(){
    var dish =$('#dish').val();
    var dish_detail =$('#dish_detail').val();
    var dish_price =$('#dish_price').val();
    var dish_type =$('#type').val();
    var qty =$('#qty').val();
    var category =$('#category').val();
    var img= jQuery('#image').val();
    is_error = '';

    if(dish==''){
        jQuery('#failed_error').html("Dish is required");
        is_error='yes';
    }

    if(dish_detail==''){
        jQuery('#failed_error').html("Dish detail field is required");
        is_error='yes';
    }
    if(dish_price==''){
        jQuery('#failed_error').html("Dish price field is required");
        is_error='yes';
    }
    if(type==''){
        jQuery('#failed_error').html("Type is required");
        is_error='yes';
    }
    if(qty==''){
        jQuery('#failed_error').html("Quantity is required");
        is_error='yes';
    }
    if(category==''){
        jQuery('#failed_error').html("Category is required");
        is_error='yes';
    }
    if(img==''){
        jQuery('#failed_error').html("Image is required");
        is_error='yes';
    }
    
    if(is_error==''){
        var type ="upload";
        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{img:img,term:type,dish:dish,dish_detail:dish_detail,qty:qty,dish_price:dish_price,dish_type:dish_type,category:category},
            success:function(result){
                if(result == 'done'){
                    location.href='dish.php';
                }
            }
        });
    }
    
});

function dish_dlt_btn(cid){
var type= "delete_btn";
jQuery.ajax({
    url:'admin_data.php',
    type:'post',
    data:{cid:cid,term:type},
    success:function(result){
        if(result == "done"){
            location.reload();
        }
        
    }
});

};

function update_dish(cid){
    var dish=$('#dish').val();
    var dish_detail=$('#dish_detail').val();
    var dish_price=$('#dish_price').val();
    var dish_type=$('#type').val();
    var category=$('#category').val();
    var image=$('#image').val();
    var type="update_dish";
    is_error = '';
    if(dish==''){
        jQuery('#failed_error').html("Dish is required");
        is_error='yes';
    }

    if(dish_detail==''){
        jQuery('#failed_error').html("Dish detail field is required");
        is_error='yes';
    }
    if(dish_price==''){
        jQuery('#failed_error').html("Dish price field is required");
        is_error='yes';
    }
    if(dish_price==''){
        jQuery('#failed_error').html("Dish type field is required");
        is_error='yes';
    }
    if(category==''){
        jQuery('#failed_error').html("Category is required");
        is_error='yes';
    }
    if(is_error==''){
    $.ajax({
        url:'admin_data.php',
        type:'post',
        data:{cid:cid,dish:dish,dish_type:dish_type,dish_detail:dish_detail,dish_price:dish_price,category:category,image:image,term:type},
        success:function(result){
            if(result=="done"){
                location.href="dish.php";
            }
            console.log(result);
        }
        });
    }

}


function sts_banner(cid,sts){
    var type="banner_status_change";
        jQuery.ajax({
            url:'admin_data.php',
            type:'post',
            data:{status:sts,cid:cid,term:type},
            success:function(result){
                if(result==0){
                    jQuery('.status-active a').html('Deactive');
                    jQuery('.status-active').addClass('status-deactive');
                    location.reload();
                }
                if(result==1){
                    jQuery('.status-deactive a').html('active');
                    jQuery('.status-deactive ').addClass('status-active');
                    location.reload();
                }
            }
        });
}


// Dashboard design start

$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});

$(function() {

    $('#side-menu').metisMenu();

});

// Loads the correct sidebar on window load, collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});



// dashboard design end



