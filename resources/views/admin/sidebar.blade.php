<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/images/users/'.Auth::user()->photo()) }}" style="height: 45px; width: 45px;" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Yonatan Nugraha</p>
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

        <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            <li class="treeview">
                <a href="#"><span>Events</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('admin/events') }}">Event List</a></li>
                    <li><a href="{{ url('admin/events/create') }}">Create Event</a></li>
                    <li><a href="{{ url('admin/collections') }}">Collection List</a></li>
                    <li><a href="{{ url('admin/collections/create') }}">Create Collection</a></li>
                </ul>
            </li>
        </ul>
    </section>

</aside>