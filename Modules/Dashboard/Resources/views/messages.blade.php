@if (session('alert-danger'))
    <section class="message" style="padding-left: 15px; padding-right: 15px; margin-top: 20px;">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                    {{ session('alert-danger') }}
                </div>
            </div>
        </div>
    </section>
@endif
@if (session('alert-success'))
    <section class="message" style="padding-left: 15px; padding-right: 15px; margin-top: 20px;">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('alert-success') }}
                </div>
            </div>
        </div>
    </section>
@endif
