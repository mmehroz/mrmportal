$(document).ready(function() {

	$(window).scroll(function(){

		var window_top = $(window).scrollTop();
		window_top +=140;
		for (var i = 0; i < $(".products_categ_wise").length; i++) {
			if(i!=$(".products_categ_wise").length-1){
				if( window_top >= $(".products_categ_wise").eq(i).position().top && window_top < $(".products_categ_wise").eq(i+1).position().top){
				
        		 $(".category_link").removeClass('active_category');
        		 $(".category_link[data-link='"+$(".products_categ_wise").eq(i).attr('id')+"']").addClass('active_category');
			       			
			       var left_position=$(".category_link[data-link='"+$(".products_categ_wise").eq(i).attr('id')+"']").position().left;
			       // left_position=30+ left_position - ($(".categories_bar").width()/2);
			       // alert($(".categories_bar").width());
			      $(".categories_bar").stop().animate({scrollLeft:left_position }, 1000);
				}
			}
			else{
				if( window_top >= $(".products_categ_wise").eq(i).position().top){
				
        		 $(".category_link").removeClass('active_category');
        		 $(".category_link[data-link='"+$(".products_categ_wise").eq(i).attr('id')+"']").addClass('active_category');
			       			
			       var left_position=$(".category_link[data-link='"+$(".products_categ_wise").eq(i).attr('id')+"']").position().left;
			       // left_position=30+ left_position - ($(".categories_bar").width()/2);
			       // alert($(".categories_bar").width());
			      $(".categories_bar").stop().animate({scrollLeft:left_position }, 1000);
				}
			}
			

		}
		
        
        // $("html, body").animate({
        //     scrollTop: category_top - (header_height + category_bar_height)
        // }, 1);

	});

    if ($(".dz_area_cart td:last-child u").html() == "Please Select Delivery Area") {

        $(".dz_area_cart").click();

    }
    $(".category_link").click(function() {

        $(".category_link").removeClass('active_category');
        $(this).addClass('active_category');
      var left_position=$(this).position().left;
    //   left_position=left_position/2;
      // console.log(left_position);
      // alert($(".categories_bar").width());
      $(".categories_bar").stop().animate({scrollLeft:left_position }, 1000);
        float_to_category($(this).attr('data-link'));
    });

    function float_to_category(category) {
        var category_top = $("#" + category).position().top;
        var header_height = $("header").height();
        var category_bar_height = $(".categories_bar").height();
        $("html, body").animate({
            scrollTop: category_top - (header_height + category_bar_height)
        }, 1);



    }


    // function category_scroll_check(){

    // 	for (var i = 0; i < $(".category_link").length; i++) {
    // 		var category_top=$(".category_link").eq(i).position().top;
    // 		var header_height=$("header").height();
    // 		var category_bar_height=$(".categories_bar").height();	



    // 		if($(window).scrollTop() > category_top - (header_height+category_bar_height)){
    // 				$(".category_link").removeClass('active_category');
    // 				$(".category_link").eq(i).addClass('active_category');
    // 		}

    // 	}



    // 	// $("html, body").animate({scrollTop : },700);	

    // }	



    $(".nav_btn").click(function() {

        $(".nav").slideToggle(300);

    });

    $(window).resize(function() {
        if (window.innerWidth > 767) {
            $(".nav").css('display', 'block');
            $(".cart_fixed").css('display', 'block');
        } else {
            $(".nav").css('display', 'none');
        }
    });

    setTimeout(function() {

        $(window).scroll();
    }, 100);


    $(window).scroll(function() {
        // if($(document).scrollTop()>90){
        // 	$(".categories_bar").addClass('sticky');
        // 	$(".cart_fixed").addClass('sticky');
        // 	$(".cart_fixed").css('height','100%');
        // }
        // else{
        // 	$(".categories_bar").removeClass('sticky');
        // 	$(".cart_fixed").removeClass('sticky');
        // }

        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
            $(".cart_fixed").css('height', window.outerHeight - 400 + "px");
        } else {
            $(".cart_fixed").css('height', '100%');
        }
        // category_scroll_check();




    });

    $(".close_cart").click(function() {

        $(".cart_fixed").hide(300);

    });


    $(".cart_mobile").click(function() {

        $(".cart_fixed").show(300);

    });

    $(".cart_mobile2").click(function() {

        $(".cart_fixed").show(300);

    });



    $(document).on('click', ".add_to_cart_btn", function() {
        $(this).removeClass('add_to_cart_btn');
        $(this).addClass('fa-check');
        $(this).removeClass('fa-plus');
        $(".fullpage_loader").css('display', 'block');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }

        });
        $.ajax({
            url: 'add-to-cart',
            method: "post",
            data: {
                product_id: $(this).attr('data-id')
            },
            success: (data) => {

                data = JSON.parse(data);


                var item = '<tr data-id="' + data.id + '"  data-product="' + data.product_id + '" data-instructions="">';
                item += '<td class="cart_item_name">';
                item += data.product_name;
                item += '</td>';
                item += '<td>';
                item += '<i class="fas fa-minus qty_minus"></i> ';
                item += '<span class="cart_item_qty">1</span>';
                item += '<i class="fas fa-plus qty_plus"></i>';
                item += ' </td>';
                item += '<td  class="cart_item_subtotal text-right">';
                item += 'Rs. ' + data.subtotal;
                item += '</td>';
                item += '</tr>';

                $(".cart_table").prepend(item);

                $(".fullpage_loader").css('display', 'none');
                bill_calculation();

            }
        });
    });


    $(document).on('click', ".add_deal", function() {

        $(".fullpage_loader").css('display', 'block');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }

        });
        $.ajax({
            url: '/menu-and-ordering/get-deal',
            method: "post",
            data: {
                id: $(this).attr('data-id')
            },
            success: (data) => {
            	$(".deal_modal_populate").html(data);
            		var check_variants = $(".check_variants").val();
            	// alert(check_variants);
            	if(check_variants!=0){

            	    $('#dealModal').modal('show');
	                $(".deal_popup_title").text($(this).parent().parent().prev().find('h4').text());
	                $(".fullpage_loader").css('display', 'none');
            	}
            	else{
             
                $(".add_to_cart_btn_deal").click();
            	}
            }
        });
    });


    $(document).on('click', ".add_to_cart_btn_deal", function() {

        var modal_data = $(".deal_modal_form").serialize();
        $(".fullpage_loader").css('display', 'block');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }

        });
        $.ajax({
            url: 'add-to-cart-deal',
            method: "post",
            data: modal_data,
            success: (data) => {

                data = JSON.parse(data);


                var item = '<tr data-id="' + data.id + '"  data-deal="' + data.deal_id + '" data-instructions="">';
                item += '<td class="cart_deal_name">';
                item += data.product_name;
                item += '</td>';
                item += '<td>';
                item += '<i class="fas fa-minus qty_minus"></i> ';
                item += '<span class="cart_item_qty">1</span>';
                item += '<i class="fas fa-plus qty_plus"></i>';
                item += ' </td>';
                item += '<td  class="cart_item_subtotal text-right">';
                item += 'Rs. ' + data.subtotal;
                item += '</td>';
                item += '</tr>';

                $(".cart_table").prepend(item);

                $(".fullpage_loader").css('display', 'none');
                bill_calculation();

            }
        });
    });

$(document).on('click', ".update_cart_btn_deal", function() {

        var modal_data = $(".deal_modal_form").serialize();
        $(".fullpage_loader").css('display', 'block');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }

        });
        $.ajax({
            url: 'update-item-deal-options',
            method: "post",
            data: modal_data,
            success: (data) => {

                
                $(".fullpage_loader").css('display', 'none');
                // bill_calculation();

            }
        });
    });


    $(".delivery_zone_btn").click(function() {

        var area = $(this).data('area');
        var minimum_amount = $(this).data('minimum');
        var delivery_charges = $(this).data('delivery');
        var dz_id = $(this).data('id');



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }
        });

        $.ajax({
            url: 'session',
            method: 'POST',
            data: {
                dz_id: dz_id,
                dz_minimum_amount: minimum_amount,
                dz_delivery_charges: delivery_charges,
                dz_area: area,
            },
            success: (data) => {
                $(".dz_area_cart td:last-child u").text(area + " (min: " + minimum_amount + ")");
                $(".dz_amount_cart").val(minimum_amount);
$(".dz_delivery_cart").val(delivery_charges);


                bill_calculation();
            }

        });



    });



    $(document).on('click', ".qty_minus", function() {


    	$(".fullpage_loader").css('display', 'block');
        
        var qty = $(this).next().text();
        var cart_item_id = $(this).parent().parent().attr('data-id');
        var product_id = $(this).parent().parent().attr('data-product');
        var deal_id = $(this).parent().parent().attr('data-deal');
        	$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
                }
            });
        if (product_id != undefined && product_id != '') {
            // product code
            if (qty == 1) {

                $.ajax({
                    url: 'remove-from-cart',
                    method: 'post',
                    data: {
                        id: cart_item_id
                    },
                    success: (data) => {
                        if (data == "Done") {

                            $(".add_btn[data-product='" + product_id + "']").addClass("add_to_cart_btn");
                            $(".add_btn[data-product='" + product_id + "']").removeClass('fa-check');
                            $(".add_btn[data-product='" + product_id + "']").addClass('fa-plus');

                            $(this).parent().parent().remove();

    						$(".fullpage_loader").css('display', 'none');
        
                            bill_calculation();
                        }

                    }
                });

            } else {

                var qty = parseInt($(this).next().html());

                var cart_item_id = $(this).parent().parent().attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
                    }
                });
                qty--;
                $.ajax({
                    url: 'update-cart-item',
                    method: 'post',
                    data: {
                        id: cart_item_id,
                        qty: qty
                    },
                    success: (data) => {
                        data = JSON.parse(data);

                        $(this).next().text(data.qty);
                        $(this).parent().next().html("Rs. " + data.subtotal);

    					$(".fullpage_loader").css('display', 'none');
        
                        bill_calculation();
                    }
                });

            }
        } else {
        	// deal code
        	if (qty == 1) {

                $.ajax({
                    url: 'remove-from-cart',
                    method: 'post',
                    data: {
                        id: cart_item_id
                    },
                    success: (data) => {
                        if (data == "Done") {

    						$(".fullpage_loader").css('display', 'none');
        
                            $(this).parent().parent().remove();
                            bill_calculation();
                        }

                    }
                });

            } else {

                var qty = parseInt($(this).next().html());

                var cart_item_id = $(this).parent().parent().attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
                    }
                });
                qty--;
                $.ajax({
                    url: 'update-cart-item-deal',
                    method: 'post',
                    data: {
                        id: cart_item_id,
                        qty: qty
                    },
                    success: (data) => {
                        data = JSON.parse(data);

                        $(this).next().text(data.qty);
                        $(this).parent().next().html("Rs. " + data.subtotal);

    					$(".fullpage_loader").css('display', 'none');
        
                        bill_calculation();
                    }
                });

            }
        }

    });



    $(document).on('click', ".qty_plus", function() {


    	$(".fullpage_loader").css('display', 'block');
        
        var qty = parseInt($(this).prev().html());

        var cart_item_id = $(this).parent().parent().attr('data-id');
        var product_id = $(this).parent().parent().attr('data-product');
        var deal_id = $(this).parent().parent().attr('data-deal');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }
        });
        qty++;
        // alert(product_id);
        if(product_id != undefined && product_id != ''){
        	$.ajax({
            url: 'update-cart-item',
            method: 'post',
            data: {
                id: cart_item_id,
                qty: qty
            },
            success: (data) => {
                data = JSON.parse(data);

                $(this).prev().text(data.qty);
                $(this).parent().next().html("Rs. " + data.subtotal);
                bill_calculation();

    			$(".fullpage_loader").css('display', 'none');
        	
            }
        });

        }
        else{
        	$.ajax({
            url: 'update-cart-item-deal',
            method: 'post',
            data: {
                id: cart_item_id,
                qty: qty
            },
            success: (data) => {
                data = JSON.parse(data);

                $(this).prev().text(data.qty);
                $(this).parent().next().html("Rs. " + data.subtotal);
                bill_calculation();
                
    			$(".fullpage_loader").css('display', 'none');
        		

            }
        });

        }
        

    });




    $(document).on('click', ".cart_item_name", function() {
    	$("#instructionsModal").modal('show');
        $(".instructions_popup_title").html($(this).html());
        $(".instructions_popup_id").val($(this).parent().attr('data-id'));
        $(".instructions_popup_text").val($(this).parent().attr('data-instructions'));

    });



    $(document).on('click', ".cart_deal_name", function() {
    	
    	$(".fullpage_loader").css('display', 'block');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='_token']").attr('content'),
            }

        });
        $.ajax({
            url: 'get-cart-deal',
            method: "post",
            data: {
                id: $(this).parent().attr('data-id')
            },
            success: (data) => {

                $(".deal_modal_populate").html(data);
                $('#dealModal').modal('show');
                $(".deal_popup_title").text($(this).text());
                $(".fullpage_loader").css('display', 'none');
            }
        });
        $(".instructions_popup_title").html($(this).html());
        $(".instructions_popup_id").val($(this).parent().attr('data-id'));
        $(".instructions_popup_text").val($(this).parent().attr('data-instructions'));

    });


    $(document).on('click',".instructions_btn",function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'add-instructions',
            method: 'post',
            data: {
                id: $(".instructions_popup_id").val(),
                instructions: $(".instructions_popup_text").val(),
            },
            success: (data) => {
                data = JSON.parse(data);
                $(".cart_items[data-id='" + $(".instructions_popup_id").val() + "']").attr('data-instructions', data.instructions);
            }
        });

    });

    $("#coupon_code").keyup(function() {


        $(".coupon_applied_btn").addClass("coupon_apply_btn");
        $(".coupon_applied_btn").html('Apply');
        $(".coupon_applied_btn").removeClass("coupon_applied_btn");

    });

    $(document).on('click', ".coupon_apply_btn", function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'apply-coupon',
            method: 'post',
            data: {
                coupon_code: $("#coupon_code").val(),
            },
            success: (data) => {
                data = JSON.parse(data);
                $(".coupon_message").css('display', 'block');
                $(".coupon_message").removeClass('text-danger');
                $(".coupon_message").removeClass('text-success');
                $(".coupon_message").addClass('text-' + data.alert);
                $(".coupon_message").text(data.message);

                var checkout_total = parseFloat($("#checkout_total_input").val());



                if (data.alert == 'success') {
                    $(".coupon_discount").css('display', 'block');

                    $(this).html("Applied");
                    $(this).removeClass("coupon_apply_btn");
                    $(this).addClass("coupon_applied_btn");
                } else {
                    $(".coupon_discount").css('display', 'none');

                    $(this).html("Apply");
                    $(this).addClass("coupon_apply_btn");
                    $(this).removeClass("coupon_applied_btn");
                }

                var new_total = Math.round((checkout_total * data.percent) / 100);
                $(".coupon_discount p span span").text(new_total)

                $(".checkout_total").text(checkout_total - new_total);




            }
        });

    });


    $(document).on('click', ".btn_confirm", function(e) {
if($(".checkout_number").val().length!=11){
$(".checkout_number").next().removeClass('d-none');
}
else{

$(".checkout_number").next().addClass('d-none');
        $(".order_form_btn").click();

}

        // $(".order_form").validate();
    });

    function bill_calculation() {

        var subtotal = 0;
        for (var i = 0; i < $(".cart_item_subtotal").length; i++) {

            subtotal += parseFloat($('.cart_item_subtotal').eq(i).html().replace("Rs.", ""));
        }

        var delivery_charges = parseInt($(".dz_delivery_cart").val());

if($(".dz_amount_cart").val() < subtotal){
delivery_charges =0;
}


        var gst = $(".gst_percent").val() * subtotal / 100;
        $(".cart_subtotal").html("Rs. " + subtotal.toFixed(1));
        $(".gst_calculated").html("Rs. " + gst.toFixed(1));
        var total = parseFloat(subtotal + gst + delivery_charges).toFixed(1);
        $(".cart_total").html("Rs. " + total);
        $(".cart_mobile_total").html("Rs. " + total);
$(".cart_delivery").html("Rs. " + delivery_charges.toFixed(1));

         if ($(".dz_amount_cart").val() == '') {

            $(".proceed_btn").removeAttr('href');
            $(".proceed_error").css('display', 'block');
            $(".proceed_error").text("Please Select Delivery Zone");
        }
 else {
            $(".proceed_btn").attr('href', 'checkout');
            $(".proceed_error").css('display', 'none');
            $(".proceed_error").text("Minimum order amount does not meet.");
        }





    }




});