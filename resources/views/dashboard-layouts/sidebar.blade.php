<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">users</span>
                    </a>
                </li>
              

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login.html" data-key="t-login">Admins</a></li>
                        <li><a href="auth-login.html" data-key="t-login">Reveiwers</a></li>
                        <li><a href="auth-register.html" data-key="t-register">Attempters</a></li>
                    </ul>
                </li> --}}


                <li class="menu-title mt-2" data-key="t-components">Task Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('languages.index') }}">
                                <span data-key="t-calendar">Languages</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('categories.index') }}">
                                <span data-key="t-chat">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dimensions.index') }}">
                                <span data-key="t-dimensions">dimensions</span>
                            </a>
                        </li>
                    </ul>
                </li>
             

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="check-square"></i>
                        <span data-key="t-tasks">Tasks</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.tasks.available')}}" data-key="t-tasks">Available Tasks</a></li>
                        <li><a href="extended-rangeslider.html" data-key="t-range-slider">Reviewed Tasks</a></li>
                        <li><a href="extended-lightbox.html" data-key="t-tasks">Completed Tasks</a></li>
                        <li><a href="{{route('admin.tasks.create')}}" data-key="t-range-slider">Create Tasks</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill badge-soft-danger  text-danger float-end">7</span>
                        <span data-key="t-forms">Forms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html" data-key="t-form-elements">Basic Elements</a></li>
                        <li><a href="form-validation.html" data-key="t-form-validation">Validation</a></li>
                        <li><a href="form-advanced.html" data-key="t-form-advanced">Advanced Plugins</a></li>
                        <li><a href="form-editors.html" data-key="t-form-editors">Editors</a></li>
                        <li><a href="form-uploads.html" data-key="t-form-upload">File Upload</a></li>
                        <li><a href="form-wizard.html" data-key="t-form-wizard">Wizard</a></li>
                        <li><a href="form-mask.html" data-key="t-form-mask">Mask</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables">Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.html" data-key="t-basic-tables">Bootstrap Basic</a></li>
                        <li><a href="tables-datatable.html" data-key="t-data-tables">DataTables</a></li>
                        <li><a href="tables-responsive.html" data-key="t-responsive-table">Responsive</a></li>
                        <li><a href="tables-editable.html" data-key="t-editable-table">Editable</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts">Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex.html" data-key="t-apex-charts">Apexcharts</a></li>
                        <li><a href="charts-echart.html" data-key="t-e-charts">Echarts</a></li>
                        <li><a href="charts-chartjs.html" data-key="t-chartjs-charts">Chartjs</a></li>
                        <li><a href="charts-knob.html" data-key="t-knob-charts">Jquery Knob</a></li>
                        <li><a href="charts-sparkline.html" data-key="t-sparkline-charts">Sparkline</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-icons">Icons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons.html" data-key="t-boxicons">Boxicons</a></li>
                        <li><a href="icons-materialdesign.html" data-key="t-material-design">Material Design</a></li>
                        <li><a href="icons-dripicons.html" data-key="t-dripicons">Dripicons</a></li>
                        <li><a href="icons-fontawesome.html" data-key="t-font-awesome">Font Awesome 5</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="map"></i>
                        <span data-key="t-maps">Maps</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google.html" data-key="t-g-maps">Google</a></li>
                        <li><a href="maps-vector.html" data-key="t-v-maps">Vector</a></li>
                        <li><a href="maps-leaflet.html" data-key="t-l-maps">Leaflet</a></li>
                    </ul>
                </li> --}}



            </ul>

            {{-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="{{asset('assets/images/giftbox.png')}}" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                        <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                        <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Sidebar -->
    </div>
</div>