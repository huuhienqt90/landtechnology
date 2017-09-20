<div class="sidebar">
    <h3>Hi {{ Auth::user()->first_name }} !!</h3>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a href="{{ route('front.dashboard.index') }}"><span class="glyphicon glyphicon-folder-close"></span>Balances</a>
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
        @if(Auth::user()->is_seller)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSell"><span class="glyphicon glyphicon-list-alt">
                    </span>Manage Selling Item</a>
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
        @endif
        @if(Auth::user()->is_buyer)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseHunting"><span class="glyphicon glyphicon-th-list">
                    </span>Manage Hunting Item</a>
                </h4>
            </div>
            <div id="collapseHunting" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('hunting.create') }}">Hunt an item</a>
                    </li>
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-eye-open text-primary"></span><a href="{{ route('hunting.index') }}">List hunting items</a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSwapping"><span class="glyphicon glyphicon-file">
                    </span>Manage Swapping Item</a>
                </h4>
            </div>
            <div id="collapseSwapping" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('swapping.create') }}">Swap an item</a>
                    </li>
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-eye-open text-primary"></span><a href="{{ route('swapping.index') }}">List swapping items</a>
                    </li>
                    <!-- <li class="list-group-item">
                        <span class="glyphicon glyphicon-eye-open text-primary"></span><a href="{{ route('front.swapping.listAccept') }}">List success swap</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
