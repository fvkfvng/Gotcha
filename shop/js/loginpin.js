$(function(){

    // ---- Pincode input with retype functionality ----- 

    var pincode = '';
    var registerpin = $('#registerpin').pinlogin({
        fields : 6,
        placeholder : '*',
        reset : false,
        autofocus : false,
        complete : function(pin){

            pincode = pin;
            $('#registerpin-block').css('display', 'none');
            
            
            // disable this instance
            $('#registerpinretype-block').css('display', 'block');
            // focus repeat instance 
            registerpinretype.focus(0);
        }
    });
    
    var registerpinretype = $('#registerpinretype').pinlogin({
        fields : 6,
        placeholder : '*',
        reset : false,
        autofocus : false,
        complete : function(pin){
            
            // compare entered pincodes
            if (pincode != pin)
            {
                pincode = '';
                
                alert ('รหัสไม่ตรงกัน กรุณาลองใหม่');

                // reset both instances
                registerpin.reset();
                registerpinretype.reset();
                
                // disable repeat instance
                $('#registerpinretype-block').css('display', 'none');

                // set focus to first instance again
                $('#registerpin-block').css('display', 'block');
                registerpin.focus(0);
            }
            else
            {
                // reset both instances
                registerpin.reset();
                registerpinretype.reset(); 
                
                // disable both instances
                registerpin.disable();
                registerpinretype.disable(); 
                
                // further processing here

                window.location.replace('register-pin-save.php?p='+ pin);
            }
        }
    });

    // ---- Single pincode input -----

    var pointpin = $('#pointpin').pinlogin({
        fields : 6,
        
        complete : function(pin){

            $.post( "api/check_pin.php", { pin: pin }).done(function( data ) {
                pointpin.reset();

                if (data == 'match') {
                    window.location.replace('points-save.php');
                    pointpin.disable();
                } else {
                    alert ('รหัสไม่ถูกต้อง');
                }
            });
        },
    });

    var deletepin = $('#deletepin').pinlogin({
        fields : 6,
        
        complete : function(pin){

            $.post( "api/check_pin.php", { pin: pin }).done(function( data ) {
                deletepin.reset();

                if (data == 'match') {
                    window.location.replace('card-delete.php');
                    deletepin.disable();
                } else {
                    alert ('รหัสไม่ถูกต้อง');
                }
            });
        },
    });
    
    // disable repeat instance at start
    $('#registerpinretype-block').css('display', 'none');
});