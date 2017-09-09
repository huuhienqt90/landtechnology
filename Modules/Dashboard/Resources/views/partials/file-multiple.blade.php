<div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-10">
        @if( count(Form::getValueAttribute($field)) )
        <div class="{{ $field }}-list-image">
            @foreach(Form::getValueAttribute($field) as $imgID => $image)
                <div class="current-image-item" id="image-item-{{ $imgID }}">
                    <img src="{{ asset('storage/'.$image) }}" />
                    <button type="button" class="btn btn-box-tool delete-image" data-id="{{ $imgID }}"><i class="fa fa-times"></i></button>
                </div>
            @endforeach
        </div>
        <div id="input-remove-{{ $field }}"></div>
        @endif
        <div id="{{ $field }}-list-image"></div>
        {!! Form::file($field.'[]',['id'=>$field, 'multiple' => true]) !!}
        @include('dashboard::partials.error', ['field' => $field])
    </div>
</div>
<script>
    jQuery(document).ready(function ($){
        $(".delete-image").click(function(){
            var id = $(this).data('id');
            var boxId = $(this).data('box-id');
            $('#input-remove-{{ $field }}').append('<input name="remove_{{ $field }}[]" type="hidden" value="'+id+'" />');
            $('#image-item-'+id).remove();
            return false;
        });
        $("#{{ $field }}").on('change', function () {

            //Get count of selected files
            var countFiles = $(this)[0].files.length;

            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            var image_holder = $("#{{ $field }}-list-image");
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
    });
</script>
