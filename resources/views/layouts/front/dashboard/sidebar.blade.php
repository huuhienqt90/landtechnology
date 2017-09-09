<div class="sidebar">
    <h3>Hi {{ Auth::user()->first_name }} !!</h3>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a href="{{ route('front.dashboard.index') }}"><span class="glyphicon glyphicon-folder-close"></span>Member area</a>
                </h4>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-user">
                    </span>My Account</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('front.user.edit') }}">Edit Infomation</a>
                    </li>
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('front.user.editPass') }}">Change Password</a>
                    </li>
                    <!-- <li class="list-group-item"> <span class="glyphicon glyphicon-comment text-success"></span><a href="http://fb.com/moinakbarali">Comments</a><span class="badge">42</span></li> -->
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSell"><span class="glyphicon glyphicon-list-alt">
                    </span>Manage Sell Item</a>
                </h4>
            </div>
            <div id="collapseSell" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('seller.create') }}">Sell an item</a>
                    </li>
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-eye-open text-primary"></span><a href="{{ route('seller.index') }}">List sell items</a>
                    </li>
                    <!-- <li class="list-group-item"> <span class="glyphicon glyphicon-comment text-success"></span><a href="http://fb.com/moinakbarali">Comments</a><span class="badge">42</span></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
