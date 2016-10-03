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
            <li>
                <a href="{{ url('admin/users') }}"><i class="fa fa-female"></i> <span>Users</span></a>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-ambulance"></i> <span>Events</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/events') }}"><i class="fa fa-circle-o"></i>Event List</a></li>
                    <li><a href="{{ url('admin/events/create') }}"><i class="fa fa-circle-o"></i>Create Event</a></li>
                    <li><a href="{{ url('admin/collections') }}"><i class="fa fa-circle-o"></i>Collection List</a></li>
                    <li><a href="{{ url('admin/collections/create') }}"><i class="fa fa-circle-o"></i>Create Collection</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-bomb"></i> <span>Journals</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/journals') }}"><i class="fa fa-circle-o"></i>Journal List</a></li>
                    <li><a href="{{ url('admin/journals/create') }}"><i class="fa fa-circle-o"></i>Create Journal</a></li>
                </ul>
            </li>
        </ul>
    </section>

</aside>