<div class="app-sidebar sidebar-shadow">

    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6 "></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading ">Dashboards</li>

                <x-side-bar route="{{ route('home') }}" sidebarname="Dashboard" icon="pe-7s-display2 "  active="admin_home_active"/>
                <x-side-bar route="{{ route('genre.index') }}" sidebarname="Create Category" icon="pe-7s-disk "  active="genre_index_active"/>

{{--                <li class="app-sidebar__heading">User Manager</li>--}}
{{--                <x-side-bar route="{{ route('user.create') }}" sidebarname="Create User" icon="pe-7s-user "  active="user_create_active"/>--}}
{{--                <x-side-bar route="{{ route('user.index') }}" sidebarname="List User" icon="pe-7s-menu "  active="user_index_active"/>--}}

                <li class="app-sidebar__heading">BLog Manager</li>
                <x-side-bar route="{{ route('blog.create') }}" sidebarname="Create Blog" icon="pe-7s-magic-wand "  active="blog_create_active"/>
                <x-side-bar route="{{ route('blog.index') }}" sidebarname="Blog List" icon="pe-7s-display2 "  active="blog_index_active"/>

                <li class="app-sidebar__heading">Contact Manager</li>
                <x-side-bar route="{{ route('contact.index') }}" sidebarname="Contact List" icon="pe-7s-phone "  active="contact_index_active"/>

            </ul>
        </div>
    </div>
</div>

