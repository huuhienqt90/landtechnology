<div class="sidebar">
    <h3>Hi {{ Auth::user()->first_name }} !!</h3>
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a href="#"><span class="glyphicon glyphicon-folder-close"></span>Member area</a>
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
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="{{ route('front.user.edit', Auth::user()->id) }}">Edit Infomation</a>
                    </li>
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="http://fb.com/moinakbarali">Change Password</a>
                    </li>
                    <!-- <li class="list-group-item"> <span class="glyphicon glyphicon-comment text-success"></span><a href="http://fb.com/moinakbarali">Comments</a><span class="badge">42</span></li> -->
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                    </span>Reports</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        Cras justo odio
                    </a>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            Cras justo odio
                        </a>
                        <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item">Morbi leo risus</a>
                        <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                        <a href="#" class="list-group-item">Vestibulum at eros</a>
                    </div>
                    <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                    <a href="#" class="list-group-item">Morbi leo risus</a>
                    <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item">Vestibulum at eros</a>
                </div>
            </div>
        </div>
    </div>
</div>
