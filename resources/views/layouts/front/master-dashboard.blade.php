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
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <!-- Select 2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <!-- File Input -->
        <link rel="stylesheet" href="{{ asset('themes/dashboard/dist/css/fileinput.min.css') }}">
        <!-- Style custom -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-dashboard.css') }}">

        <!-- File Input -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('themes/dashboard/dist/js/fileinput.min.js') }}"></script>
        <style type="text/css">
            .kv-file-upload{
                display: none;
            }
        </style>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
    <body>
        <!-- Header -->
        @include('layouts.front.commons.header')
        <!-- End header -->

        @include('front.messages')

        <!-- Content -->
        <div class="container">
            <div class="row">
                @if(Auth::user()->confirmed)
                    <div class="col-md-3 col-sm-12">
                        <div class="sidebar">
                            @include('layouts.front.dashboard.sidebar')
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="main-content">
                            @yield('content-dashboard')
                        </div>
                    </div>
                @else
                    <div class="col-md-12 mg-top-50">
                        <div class="alert alert-warning" role="alert">
                            <a href="{{ route('front.user.verify', Auth::user()->id) }}" class="alert-link">Your account is not active. Please activate your account from the link in the welcome email.</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.front.commons.footer')
        <!-- End footer -->

        <!-- Script -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('themes/dashboard/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <!-- Select 2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script src="{{ asset('assets/js/notify.min.js') }}"></script>
        <script type="text/javascript">
        jQuery(document).ready(function($){
            $('input[name="name"]').keyup(function(e){
                $('input[name="slug"]').val(convertToSlug($(this).val()));
                return true;
            });
            function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-')
                    ;
            }

            // Review image
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#feature_image-prev').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#feature_image").change(function(){
                readURL(this);
            });

            // Review images
            $(".delete-image").click(function(){
                var id = $(this).data('id');
                var boxId = $(this).data('box-id');
                $('#input-remove-product_images').append('<input name="remove_product_images[]" type="hidden" value="'+id+'" />');
                $('#image-item-'+id).remove();
                return false;
            });
            $("#product_images").on('change', function () {

                //Get count of selected files
                var countFiles = $(this)[0].files.length;

                var imgPath = $(this)[0].value;
                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                var image_holder = $("#product_images-list-image");
                image_holder.empty();

                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                    if (typeof (FileReader) != "undefined") {

                        //loop for each file selected for uploaded.
                        for (var i = 0; i < countFiles; i++) {

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                image_holder.append('<div class="current-image-item"><img src="'+e.target.result+'" /></div>');
                            }

                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[i]);
                        }

                    } else {
                        alert("This browser does not support FileReader.");
                    }
                } else {
                    alert("Pls select only images");
                }
            });
            $('#description').wysihtml5();
            $('#description_short').wysihtml5();
            $('.select2').select2();
        });
    </script>
    @include('front.messages')
    </body>
</html>
