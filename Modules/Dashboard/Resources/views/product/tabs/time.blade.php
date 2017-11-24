<p>&nbsp;</p>
<div class="row">
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" id="add-new-time">Add new time</button>
            </span>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<?php $i = 0; ?>
<div id="old_time">
    @if( isset($product->booking) && count($product->booking) > 0 )
        @foreach(unserialize($product->booking->date_time_booking) as $key => $item)
            @if( is_numeric($key) )
                <?php $i++; ?>
                <div class="row">
                    <div class="col-md-2">
                        <label for="control-label">
                            Time Order
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date_time_booking[{{ $key }}]['date']" value="{{ $item["'date'"] }}" class="form-control pull-right datepicker">
                            </div>
                            <!-- /.input group -->
                         </div>
                    </div>
                    <div class="col-md-3 bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time:</label>

                            <div class="input-group">
                                <input type="text" name="date_time_booking[{{ $key }}]['time']" value={{ $item["'time'"] }} class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
<div id="new_time"></div>
<p>&nbsp;</p>
<div id="preset" class="hidden">
    <div class="row">
        <div class="col-md-2">
            <label for="control-label">
                Time Order
            </label>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Date:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date_time_booking[!#name#!]['date']" class="form-control pull-right datepicker">
                </div>
                <!-- /.input group -->
             </div>
        </div>
        <div class="col-md-3 bootstrap-timepicker">
            <div class="form-group">
                <label>Time:</label>

                <div class="input-group">
                    <input type="text" name="date_time_booking[!#name#!]['time']" class="form-control timepicker">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
                <!-- /.input group -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function($) {
        dateTime();
        var count = {{ $i }};
        $("#add-new-time").on('click', function() {
            var html = $("#preset").clone().html();
            var text = html.replace(new RegExp('!#name#!', 'g'), count);
            $("#new_time").append(text);
            // Date picker
            dateTime();
            count++;
        });
    });
    function dateTime() {
        $('.datepicker').datepicker({
          autoclose: true
        });
        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        });
    }
</script>