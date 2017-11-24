<p>&nbsp;</p>
<div class="row">
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" id="add-new-option">Add options</button>
            </span>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php $y = 0; ?>
<div id="old_options">
    @if( isset($product->booking) && count($product->booking) > 0 )
        @foreach(unserialize($product->booking->option_booking) as $key => $item)
            @if( is_numeric($key) )
                <?php $y++; ?>
                <div class="row">
                    <div class="col-md-2">
                        <label for="control-label">
                            Option
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="option_booking[{{ $key }}]['name']" value='{{ $item["'name'"] }}' class="form-control">
                            <!-- /.input group -->
                         </div>
                    </div>
                    <div class="col-md-3 bootstrap-timepicker">
                        <div class="form-group">
                            <label>Price:</label>

                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                    <input type="text" name="option_booking[{{ $key }}]['price']" value='{{ $item["'price'"] }}' class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
<div id="new_options"></div>
<p>&nbsp;</p>
<div id="preset_option" class="hidden">
    <div class="row">
        <div class="col-md-2">
            <label for="control-label">
                Option
            </label>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="option_booking[!#name#!]['name']" class="form-control">
                <!-- /.input group -->
             </div>
        </div>
        <div class="col-md-3 bootstrap-timepicker">
            <div class="form-group">
                <label>Price:</label>

                <div class="input-group">
                    <span class="input-group-addon">$</span>
                        <input type="text" name="option_booking[!#name#!]['price']" class="form-control">
                    <span class="input-group-addon">.00</span>
                </div>
                <!-- /.input group -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function($) {
        var count = {{ $y }};
        $("#add-new-option").on('click', function() {
            var html = $("#preset_option").clone().html();
            var text = html.replace(new RegExp('!#name#!', 'g'), count);
            $("#new_options").append(text);
            count++;
        });
    });
</script>