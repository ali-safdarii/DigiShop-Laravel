<!-- Sidebar -->
<div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
    <i class="fas fa-user-secret me-2"> </i>Codersbite
</div>


<div class="list-group list-group-flush my-3">

    <a href="{{route('admin.dashboard')}}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::is('admin/dashboard') ? 'active' : '' }} "><i
            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

    {{--content_submenu--}}
    <a id="dropdown_header" href="#content_submenu" data-bs-toggle="collapse"
       class="list-group-item list-group-item-action bg-transparent second-text {{ Request::is('admin/dashboard/content*') ? 'active' : '' }}">

        <i class="fas fa-edit"> </i>
        <span class="ms-1">
            <i class="fas fa-caret-down float-end "></i>
                        Content
                    </span>
    </a>
    <div class="collapse list-group " id="content_submenu">

        <a href="{{route('content.postCategory.index')}}"
           class=" bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="nav_name">Categories</span>
        </a>

        <a href="{{route('content.post.index')}}"
           class=" bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="nav_name">Posts</span>
        </a>

        <a href="{{route('content.comment.index')}}"
           class=" bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="nav_name">Comments</span>
        </a>

        <a href="{{route('content.banners.index')}}"
           class=" bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="nav_name">Banners</span>
        </a>
    </div>
    {{--end content_submenu--}}

    {{--Market sub-menu --}}
    <a id="dropdown_header" href="#market_submenu" data-bs-toggle="collapse"
       class="list-group-item list-group-item-action bg-transparent second-text {{ Request::is('admin/dashboard/market*') ? 'active' : '' }} ">

        <i class="fas fa-store"> </i>
        <span class="ms-1">
            <i class="fas fa-caret-down float-end "></i>
                        E-commerce
                    </span>
    </a>
    <div class="collapse list-group " id="market_submenu">


        <a href="{{route('market.brand.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Brands</span>
        </a>
        <a href="{{route('market.delivery.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Deliveries</span>
        </a>

        <a href="{{route('market.category.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Categories</span>
        </a>

        <a href="{{route('market.product.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Products</span>
        </a>

        <a href="{{route('market.attributes.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Attributes</span>
        </a>

        <a href="{{route('market.comments.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Comments</span>
        </a>

        <a href="{{route('market.payments.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Payments</span>
        </a>

        <a href="{{route('market.discounts.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Discounts</span>
        </a>

        <a href="{{route('market.amazing-sale.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="text-danger">AmazingSale</span>
        </a>

    </div>
    {{--End Market sub-menu --}}

    {{-- users_submenu --}}
    <a id="dropdown_header" href="#users_submenu" data-bs-toggle="collapse"
       class="list-group-item list-group-item-action bg-transparent second-text {{ Request::is('admin/dashboard/users*') ? 'active' : '' }} ">

        <i class="fas fa-users"> </i> <span class="ms-1"> <i class="fas fa-caret-down float-end "></i>Users</span>


    </a>
    <div class="collapse list-group " id="users_submenu">


        <a href="{{route('admin.admin.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Admins</span>
        </a>
        <a href="#" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Customers</span>
        </a>

        <a href="{{route('admin.role.index')}}" class="bg-transparent second-text">
            <i class="fas fa-xs fa-angles-right"></i>
            <span class="">Roles</span>
        </a>

    </div>
    {{--end users_submenu --}}





    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-project-diagram me-2"></i>Projects</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-chart-line me-2"></i>Analytics</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-paperclip me-2"></i>Reports</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-shopping-cart me-2"></i>Store Mng</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-gift me-2"></i>Products</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-comment-dots me-2"></i>Chat</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            class="fas fa-map-marker-alt me-2"></i>Outlet</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
            class="fas fa-power-off me-2"></i>Logout</a>
</div>
<!-- /#sidebar-wrapper -->




@section('custom-script')

    <script>
    </script>
@endsection
