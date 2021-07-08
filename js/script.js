$(document).ready(function(){
	$('#agree1, #agree2').on('change', function() {
        var agree1 = $('#agree1').prop('checked');
        var agree2 = $('#agree2').prop('checked');
        if (agree1 == true && agree2 == true) {
            $('#btn-submit').attr('disabled', false);
        } else {
            $('#btn-submit').attr('disabled', true);
        }
    });

  	$("#btn-submit").click(function() {
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

    /* Card */
    $('#card-selected').on('click', function() {
        $('.main-container').addClass('card-selected');
    });

    $('#card-unselected').on('click', function() {
      $('.main-container').removeClass('card-selected');
    });

    $('#delete-card').on('click', function() {
      var n = $( "input:checked" ).length;
      $('#delete-count').html(n);
    });
});