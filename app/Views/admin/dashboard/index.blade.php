@extends('admin._master')

@section('page-toolbar')

@endsection

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-tasks"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $pagesCount }}
                </div>
                <div class="desc">
                    Total pages
                </div>
            </div>
            <a class="more" href="{{ '/'.$adminCpAccess.'/pages' }}">
                Explore <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="icon-layers"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $postsCount }}
                </div>
                <div class="desc">
                    Total posts
                </div>
            </div>
            <a class="more" href="{{ '/'.$adminCpAccess.'/posts' }}">
                Explore <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow-gold">
            <div class="visual">
                <i class="fa fa-cubes"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $productsCount }}
                </div>
                <div class="desc">
                    Total products
                </div>
            </div>
            <a class="more" href="{{ '/'.$adminCpAccess.'/products' }}">
                Explore <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-sharp">
            <div class="visual">
                <i class="fa fa-cubes"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $usersCount }}
                </div>
                <div class="desc">
                    Total activated users
                </div>
            </div>
            <a class="more" href="{{ '/'.$adminCpAccess.'/users' }}">
                Explore <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<!-- END DASHBOARD STATS -->
@endsection
