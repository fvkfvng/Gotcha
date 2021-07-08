$(document).ready(function(){  
	$('#agree1, #agree2').on('change', function() {
        var agree1 = $('#agree1').prop('checked');
        var agree2 = $('#agree2').prop('checked');

        if (agree1 == true && agree2 == true) {
            $('#next1').attr('disabled', false);
        } else {
            $('#next1').attr('disabled', true);
        }
    });

    $('#agree3').on('change', function() {
        var agree3 = $('#agree3').prop('checked');
        if (agree3 == true) {
            $('#btn-submit').attr('disabled', false);
        } else {
            $('#btn-submit').attr('disabled', true);
        }
    });

  	$(".next").click(function() {
  		var btnid = $(this).prop('id');
  		
  		if (btnid == 'next1') {
  			if ($('#name').val() == '') {
  				$('#name').addClass('input-empty');
  				$('.input-name').html('กรุณาเพิ่ม ชื่อ-นามสกุล');
  				return false;
  			}

  			if ($('#email').val() == '') {
  				$('#email').addClass('input-empty');
  				$('.input-email').html('กรุณาเพิ่มอีเมล');
  				return false;
  			}

  			if ($('#tel').val() == '') {
  				$('#tel').addClass('input-empty');
  				$('.input-tel').html('กรุณาเพิ่มเบอร์โทรศัพท์');
  				return false;
  			}

  			if ($('#dayofbirth').val() == '') {
  				$('#dayofbirth').addClass('input-empty');
  				$('.input-date').html('กรุณาเพิ่มวันเกิด');
  				return false;
  			}

  			if ($('#monthofbirth').val() == '') {
  				$('#monthofbirth').addClass('input-empty');
  				$('.input-date').html('กรุณาเพิ่มเดือนเกิด');
  				return false;
  			}

  			if ($('#yearofbirth').val() == '') {
  				$('#yearofbirth').addClass('input-empty');
  				$('.input-date').html('กรุณาเพิ่มปีเกิด');
  				return false;
  			}
  		}

  		if (btnid == 'next2') {
  			if ($('#shop_name').val() == '') {
  				$('#shop_name').addClass('input-empty');
  				$('.input-shop-name').html('กรุณาเพิ่มชื่อร้านค้า');
  				return false;
  			}

  			if ($('#shop_type').val() == '') {
  				$('#shop_type').addClass('input-empty');
  				$('.input-shop-type').html('กรุณาเพิ่มประเภทร้านค้า');
  				return false;
  			}

  			if ($('#shop_branch1').prop('checked') == false && $('#shop_branch2').prop('checked') == false) {
  				$('.input-shop-branch').html('กรุณาเลือกสาขา');
  				return false;
  			}

  			if ($('#shop_point').val() == '') {
  				$('#shop_point').addClass('input-empty');
  				$('.input-shop-price').html('กรุณาเพิ่มคะแนน');
  				return false;
  			}

  			if ($('#shop_price').val() == '') {
  				$('#shop_price').addClass('input-empty');
  				$('.input-shop-price').html('กรุณาเพิ่มราคา');
  				return false;
  			}

  			if ($('#shop_detail').val() == '') {
  				$('#shop_detail').addClass('input-empty');
  				$('.input-shop-detail').html('กรุณาเพิ่มรายละเอียด');
  				return false;
  			}
  		}

  		if (btnid == 'next3') {
  			if ($('#address_no').val() == '') {
  				$('#address_no').addClass('input-empty');
  				$('.input-address-no').html('กรุณาเพิ่มเลขที่');
  				return false;
  			}

  			if ($('#address_detail').val() == '') {
  				$('#address_detail').addClass('input-empty');
  				$('.input-address-detail').html('กรุณาเพิ่มรายละเอียดเพิ่มเติม');
  				return false;
  			}
  		}

        let previous = $(this).closest("fieldset").attr('id');
        let next = $('#'+this.id).closest('fieldset').next('fieldset').attr('id');
        $('#'+next).show();
        $('#'+previous).hide();
  	});

  	$('input, textarea').on('keypress', function() {
  		$(this).removeClass('input-empty');
  		$(this).parent().find('.input-error').html('');
  	});

  	$('#dayofbirth, #monthofbirth, #yearofbirth').on('change', function() {
  		$(this).removeClass('input-empty');
  		$('.input-date').html('');
  	});

  	$('#shop_branch1, #shop_branch2').on('change', function() {
  		$('.input-shop-branch').html('');
  	});

    /* Point */
    $('#form-point input[name=type]').on('click', function() {
      var val = $(this).val();

      if (val == 1) {
        $('#form-point #tel').attr('disabled', false);
        $("#point-submit1").show();
        $("#point-submit2").hide();
      } else {
        $('#form-point #tel').attr('disabled', true);
        $("#point-submit1").hide();
        $("#point-submit2").show();
      }
    });

    $('#form-point #total').on('keyup', function() {
      var val = $(this).val();
      var shop_price = $('#form-point #shop-price').val();
      var shop_point = $('#form-point #shop-point').val();
      var p = 0;
      var point = 0;

      p = val / shop_price;
      point = parseInt(p) * shop_point;
      
      $('#form-point #point').val(point);
    });

    $("#point-submit1").click(function() {

      if ($('#tel').val() == '') {
        $('#tel').addClass('input-empty');
        $('.input-tel').html('กรุณาเพิ่มเบอร์โทรศัพท์');
        return false;
      }

      if ($('#total').val() == '') {
        $('#total').addClass('input-empty');
        $('.input-total').html('กรุณาเพิ่มยอดซื้อขาย');
        return false;
      }

      $('#form-point').submit();
    });

    $("#point-submit2").click(function() {

      if ($('#total').val() == '') {
        $('#total').addClass('input-empty');
        $('.input-total').html('กรุณาเพิ่มยอดซื้อขาย');
        return false;
      }

      $('#form-point').submit();
      
    });
});