<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/images/users/'.Auth::user()->photo()) }}" style="height: 45px; width: 45px;" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>

        <ul class="sidebar-menu" style="font-weight: 400">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-blind"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/users') }}"><i class="fa fa-circle-o"></i>User List</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-rocket"></i> <span>Events</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/events') }}"><i class="fa fa-circle-o"></i>Event List</a></li>
                    <li><a href="{{ url('admin/events/create') }}"><i class="fa fa-circle-o"></i>Create Event</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-paw"></i> <span>Collections</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/collections') }}"><i class="fa fa-circle-o"></i>Collection List</a></li>
                    <li><a href="{{ url('admin/collections/create') }}"><i class="fa fa-circle-o"></i>Create Collection</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-coffee"></i> <span>Journals</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/journals') }}"><i class="fa fa-circle-o"></i>Journal List</a></li>
                    <li><a href="{{ url('admin/journals/create') }}"><i class="fa fa-circle-o"></i>Create Journal</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/orders') }}"><i class="fa fa-circle-o"></i>Order List</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-headphones"></i> <span>Tickets</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/tickets') }}"><i class="fa fa-circle-o"></i>Ticket List</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-fire"></i> <span>Banners</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/banners') }}"><i class="fa fa-circle-o"></i>Banner List</a></li>
                    <li><a href="{{ url('admin/banners/create') }}"><i class="fa fa-circle-o"></i>Create Banner</a></li>
                </ul>
            </li>
        </ul>
    </section>

</aside>