           <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                        
                        <li>
                            <a href="{{url('/')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>                        
                        <li>
                            <a href="{{url('estimates')}}"><i class="fa fa-list-alt fa-fw"></i> Estimates</a>
                        </li>
                        <li>
                            <a href="{{url('jobs')}}"><i class="fa fa-briefcase fa-fw"></i> Jobs</a>
                        </li>
						<li>
                            <a href="{{url('customers')}}"><i class="fa fa-users fa-fw"></i> Customers</a>
                        </li>
                        <li>
                            <a href="{{url('suppliers')}}"><i class="fa fa-truck fa-fw"></i> Suppliers</a>
                        </li>
                        <li>
                            <a href="{{url('items')}}"><i class="fa fa-cogs fa-fw"></i> Items</a>
                        </li>
			            <li>
                            <a href="{{url('orders')}}"><i class="fa fa-file-text-o fa-fw"></i> Purchase Orders</a>
                        </li>
						<li>
                            <a href="{{url('grn')}}"><i class="fa fa-refresh fa-fw"></i> GRN</a>
                        </li>
						<li>
                            <a href="{{url('issue_notes')}}"><i class="fa fa-check-square-o fa-fw"></i> Issue Notes</a>
                        </li>
						<li>
                            <a href="{{url('invoices')}}"><i class="fa fa-share fa-fw"></i> Invoices</a>
                        </li>
                        <li>
                            <a href="{{url('labours')}}"><i class="fa fa-clock-o"></i> Labours</a>
                        </li>
                        <li>
                            <a href="{{url('consumptions')}}"><i class="fa fa-folder-open"></i> Consumptions</a>
                        </li>

                        @role('owner')
                        <li>
                            <a href="{{url('reports')}}"><i class="fa fa-line-chart"></i> Reports</a>
                        </li>
                        @endrole


                        <li>
                            <a href="{{url('settings')}}"><i class="fa fa-wrench"></i> Settings</a>
                        </li>

                        @role('owner')
                        <li>
                            <a href="{{url('users')}}"><i class="fa fa-user fa-fw"></i> Users</a>
                        </li>
                        @endrole

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
     
    