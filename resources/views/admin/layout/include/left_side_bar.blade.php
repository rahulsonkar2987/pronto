<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->

        
            <ul class="list-unstyled">
                <li><a href="{{route('admin.dashboard')}}"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
                <li><a href="{{route('admin.coupon.index')}}"><i class="fa fa-gift"></i><span>Coupon</span></a></li>
                <li><a href="{{route('admin.banner.index')}}"><i class="fa-solid fa-panorama"></i><span>Banner management</span></a></li> 
                <li><a href="{{route('admin.author.index')}}"><i class="fa-solid fa-user-pen"></i><span>Author</span></a></li> 
                <li><a href="{{route('admin.manage-book.index')}}"><i class="fa-solid fa-book"></i><span>Manage book</span></a></li> 
                

                <li><a href="#Categories" aria-expanded="false" data-toggle="collapse">
                    <i class="fa fa-wrench" aria-hidden="true"></i><span>Categories</span></a>
                    <ul id="Categories" class="collapse @yield('categories')  list-unstyled pt-0">
                        <li><a  class="@yield('main_category_active')" href="{{route('admin.main_category.index')}}">Service Categories</a></li>
                        {{-- <li><a class="@yield('pets')" href="{{ route('admin.pet_category.index') }}">Pets Categories</a></li> --}}
                    </ul>
                </li>

                <li><a style="color: @yield('user')" href="{{route('admin.user.index')}}"><i class="ti ti-user"></i><span>User</span></a></li> 
                <li><a href="#manage_admin" aria-expanded="false" data-toggle="collapse">
                    <i class="fa-solid fa-users"></i><span>Manage Admin</span></a>
                    <ul id="manage_admin" class="collapse list-unstyled pt-0">
                        <li><a href="{{ route('admin.manage.index') }}">Admin</a></li>
                        <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    </ul>
                </li>

                <li><a href="#setting" aria-expanded="false" data-toggle="collapse">
                    <i class="fa-solid fa-gear"></i><span>Setting</span></a>
                    <ul id="setting" class="collapse list-unstyled pt-0">
                        <li><a href="{{ route('admin.setting.general.index',['general']) }}">General</a></li>
                        <li><a href="{{ route('admin.setting.social.index') }}">Social Login</a></li>
                        <li><a href="{{route('admin.edit.password')}}">Change Password </a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.order.index') }}"><i class="fa-brands fa-first-order"></i><span>Orders</span></a></li> 
                {{-- <li><a href="{{ route('admin.rating.index') }}"><i class="fa-regular fa-star"></i><span>Rating</span></a></li>  --}}

                <li><a href="{{ route('admin.faq.index') }}"><i class="fa fa-question-circle" aria-hidden="true"></i><span>Faq</span></a></li> 

                <li><a style="color: @yield('help')"  href="{{ route('admin.help.index') }}"><i class="fa-brands fa-hire-a-helper"></i><span>Help</span></a></li> 
            </ul>

        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>