@php
    $user = Auth::user();
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="/dashboard">
            <img src="{{(!empty($setting->logo)) ? url('images/setting/'.$setting->logo):url('images/profile/no_image.jpeg') }}" class="logo-icon" alt="logo icon">
            </a>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/dashboard" >
                <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <!--Manage Category  -->
        @if ($user->can('category-list') or $user->can('transactions-list'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-line-chart"></i></div>
                    <div class="menu-title">Manage Transactions</div>
                </a>
                <ul>
                    @if ($user->can('category-list'))
                        <li> <a href="{{route('CategoryAll')}}"><i class="bx bx-right-arrow-alt"></i>All Category</a></li>
                    @endif
                    @if ($user->can('transactions-list'))
                        <li> <a href="{{route('TransactionAll')}}"><i class="bx bx-right-arrow-alt"></i>All Transaction</a></li>
                    @endif
                </ul>
            </li>
        @endif


        <!--Manage Purchase  -->
        @if ($user->can('purchase-list'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cart"></i>
                </div>
                <div class="menu-title">Manage Purchase</div>
            </a>
            <ul>
                <li> <a href="{{route('purchasesAll')}}"><i class="bx bx-right-arrow-alt"></i>All Purchase</a></li>
            </ul>
        </li>
        @endif

        <!--Manage purchase  -->
        @if ($user->role=='1')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fadeIn animated bx bx-user-check"></i></div>
                <div class="menu-title">Manage User</div>
            </a>
            <ul>
                <li> <a href="{{route('userAll')}}"><i class="bx bx-right-arrow-alt"></i>All Users</a></li>
                <li> <a href="{{route('roleMnage')}}"><i class="bx bx-right-arrow-alt"></i>All Role Permission</a></li>
                <li> <a href="{{route('AddRolePermission')}}"><i class="bx bx-right-arrow-alt"></i>Add Role Permission</a></li>
            </ul>
        </li>
        @endif

        <!--Manage Setting  -->
        @if ($user->can('setting-menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cogs"></i>
                </div>
                <div class="menu-title">Manage Setting</div>
            </a>
            <ul>
                @if ($user->can('setting-edit'))
                    <li> <a href="{{route('GetSetting')}}"><i class="bx bx-right-arrow-alt"></i>All Settings</a></li>
                @endif
            </ul>
        </li>
        @endif


    </ul>
</div>
