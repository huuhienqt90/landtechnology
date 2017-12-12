<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('themes/dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->getFullName() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview{{ $menuActive == 'dashboard' ? ' active' : '' }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li{{ $subMenuActive == 'home' ? ' class=active' : '' }}><a href="{{ url('dashboard') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                </ul>
            </li>
            <li class="treeview{{ $menuActive == 'products' ? ' active' : '' }}">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Products</span>
                </a>
                <ul class="treeview-menu">
                    <li{{ $subMenuActive == 'product' ? ' class=active' : '' }}><a href="{{ route('dashboard.product.index') }}"><i class="fa fa-circle-o"></i> List products</a></li>
                    <li{{ $subMenuActive == 'group-attribute' ? ' class=active' : '' }}><a href="{{ route('dashboard.attribute-group.index') }}"><i class="fa fa-circle-o"></i> Group Attributes</a></li>
                    <li{{ $subMenuActive == 'attribute' ? ' class=active' : '' }}><a href="{{ route('dashboard.attribute.index') }}"><i class="fa fa-circle-o"></i> Attributes</a></li>
                    <li{{ $subMenuActive == 'tag' ? ' class=active' : '' }}><a href="{{ route('dashboard.tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>
                    <li{{ $subMenuActive == 'brand' ? ' class=active' : '' }}><a href="{{ route('dashboard.brand.index') }}"><i class="fa fa-circle-o"></i> Brands</a></li>
                    <li{{ $subMenuActive == 'category' ? ' class=active' : '' }}><a href="{{ route('dashboard.category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
                    <li{{ $subMenuActive == 'sell-type' ? ' class=active' : '' }}><a href="{{ route('dashboard.sell-type.index') }}"><i class="fa fa-circle-o"></i> Sell Types</a></li>
                    <li{{ $subMenuActive == 'seller-shipping' ? ' class=active' : '' }}><a href="{{ route('dashboard.seller-shipping.index') }}"><i class="fa fa-circle-o"></i> Seller Shippings</a></li>
                </ul>
            </li>
            <li class="treeview{{ $menuActive == 'ecommerce' ? ' active' : '' }}">
                <a href="#">
                    <i class="fa fa-shopping-basket"></i>
                    <span>E-Commerce</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dashboard.order.index') }}"><i class="fa fa-circle-o"></i> Orders</a></li>
                    <li><a href="{{ route('dashboard.coupon.index') }}"><i class="fa fa-circle-o"></i> Coupons</a></li>
                    <li><a href="{{ route('dashboard.setting.index') }}"><i class="fa fa-circle-o"></i> Settings</a></li>
                    <li><a href="{{ route('dashboard.commission.index') }}"><i class="fa fa-circle-o"></i> Commissions</a></li>
                    <li><a href="{{ route('dashboard.payment-history.index') }}"><i class="fa fa-circle-o"></i> Payment Histories</a></li>
                </ul>
            </li>
            <li class="treeview{{ $menuActive == 'users' ? ' active' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li><a href="{{ route('dashboard.role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li><a href="{{ route('dashboard.country.index') }}"><i class="fa fa-circle-o"></i> Countries</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
