<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Meta & title -->
        @yield('meta')

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frameworks.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-social.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/font-elegant.css') }}">
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

        <!-- Style Dashboard -->
        @yield('style-dashboard')
    </head>
    <body>
        <!-- Header -->
        @include('layouts.front.commons.header')
        <!-- End header -->

        <!-- Content -->
        @yield('content')
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.front.commons.footer')
        <!-- End footer -->
        
        <!-- Script -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/price.js') }}"></script>
        <script src="{{ asset('assets/js/grid-list-show.js') }}"></script>
        <!-- Detail product -->
        <script src="{{ asset('assets/js/notify.min.js') }}"></script>
        <script src="{{ asset('assets/js/product-detail.js') }}"></script>
        <script src="{{ asset('assets/js/slider-slick.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
                $('.overlay').click(function(){
                    var url = $(this).parent().find('.product-detail-url').attr('href');
                    if( typeof url === "undefined"){
                        return true;
                    }else{
                        window.location = url;
                        return false;
                    }

                });
                $('.rating input').each(function () {
                   if($(this).is(':checked')){
                       $('.rating label').removeClass('hovered');
                       $(this).parent().addClass('hovered');
                   }
                });
                $('.rating input').change(function () {
                    $('.rating label').removeClass('hovered');
                    if($(this).is(':checked')){
                        $(this).parent().addClass('hovered');
                    }
                });

                $("#payment-stripe").change(function() {
                    $("#area-payment-stripe").append('<div class="row"><div class="col-md-12"><div class="form-group"><label>Card Number</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-credit-card"></i></span><input type="text" name="card_no" required value="{{ old('card_no') }}" class="form-control" placeholder="Valid Card Number"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Month</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" class="form-control" required placeholder="MM"></div></div></div><div class="col-md-3"><div class="form-group"><label>Expiry Year</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard"></i></span><input type="text" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" class="form-control" required placeholder="YYYY"></div></div></div><div class="col-md-6"><div class="form-group"><label>CVV No.</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-vcard-o"></i></span><input type="text" name="cvvNumber" required value="{{ old('cvvNumber') }}" class="form-control" placeholder="CVC"></div></div></div><div class="col-md-12"><div class="form-group"><label>Amount</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-usd"></i></span><input type="text" name="amount" required value="{{ Cart::total() }}" class="form-control" placeholder="0"></div></div></div></div>');
                });
                $("#payment-paypal").change(function() {
                    $("#area-payment-stripe").html('');
                });

                $("#autofillShip").on('click', function() {
                    var billingFirstName = $("input[name=billingFirstName]").val();
                    var billingLastName = $("input[name=billingLastName]").val();
                    var billingCompany = $("input[name=billingCompany]").val();
                    var billingAddress1 = $("input[name=billingAddress1]").val();
                    var billingAddress2 = $("input[name=billingAddress2]").val();
                    var billingPostCode = $("input[name=billingPostCode]").val();
                    var billingCity = $("input[name=billingCity]").val();
                    var billingPhone = $("input[name=billingPhone]").val();
                    var billingEmail = $("input[name=billingEmail]").val();
                    $("input[name=shippingFirstName]").val(billingFirstName);
                    $("input[name=shippingLastName]").val(billingLastName);
                    $("input[name=shippingCompany]").val(billingCompany);
                    $("input[name=shippingAddress1]").val(billingAddress1);
                    $("input[name=shippingAddress2]").val(billingAddress2);
                    $("input[name=shippingPostCode]").val(billingPostCode);
                    $("input[name=shippingCity]").val(billingCity);
                    $("input[name=shippingPhone]").val(billingPhone);
                    $("input[name=shippingEmail]").val(billingEmail);
                });
            });
            
            //plugin bootstrap minus and plus
            //http://jsfiddle.net/laelitenetwork/puJ6G/
            $('.btn-number').click(function(e){
                e.preventDefault();
                
                fieldName = $(this).attr('data-field');
                type      = $(this).attr('data-type');
                var input = $("input[name='"+fieldName+"']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if(type == 'minus') {
                        
                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        } 
                        if(parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if(type == 'plus') {

                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function(){
               $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {
                
                minValue =  parseInt($(this).attr('min'));
                maxValue =  parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());
                
                name = $(this).attr('name');
                if(valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if(valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                
                
            });

            $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                     // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        </script>
        @include('front.messages')
    </body>
</html>