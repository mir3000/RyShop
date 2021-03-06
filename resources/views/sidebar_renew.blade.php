<ul class="menu">
@if(Auth::User())
    <!-- menu header text -->
        <li class="divider" data-content="个人信息">
        </li>
        <!-- menu item -->
        <li class="menu-item">
            <a href="/home">
                {{Auth::User()->name}} <small><small>UID：{{Auth::User()->id}}</small></small>
            </a>
            <a href="/home">
                <small>Mail：{{Auth::User()->email}}</small>
            </a>

            <a href="/home">
                <small>QQ：{{Auth::User()->qq}}</small>
            </a>

        </li>
        <li class="divider" data-content="续费信息">
        </li>
        <!-- menu item -->
        <li class="menu-item">
            <a><?php $good_name = \App\Good::whereRaw("model='".$host->model."'")->get(); echo $good_name[0]->name ?? "已下架";?> <small>{{$host->model}}</small></a>
            <a><small>原订单号：{{$host->order_no}}</small></a>
            <a><small>新订单号：<?php $order_no = date("ymd").rand(1000000,9999999);echo $order_no;?></small></a>
            <a><small>网站账户：{{$host->host_name}}</small></a>
            <a>
                <small>原有效期：{{\Carbon\Carbon::parse($host->end_at.'- 1 year')->toDateString()}}</small>
            </a>
            <a>
                <small>新有效期：{{$host->end_at}}</small>
            </a>
            <a>
                <big><big>{{$host->price}}</big></big> 元
            </a>

        </li>
    @else
        <div class="empty">
            <div class="empty-icon">
                <i class="icon icon-people"></i>
            </div>
            <h4 class="empty-title">请登录</h4>
            <p class="empty-subtitle">您还没有登录系统，请登录之后继续购买哦！</p>
            <div class="empty-action">
                <a href="/auth/login" class="btn btn-primary">登录</a>
                <a href="/auth/register" class="btn">注册</a>
            </div>
        </div>

    @endif
</ul>
@if(Auth::User())
    {!!  Form::open(['url'=>'/order/renew']) !!}
    {!! Form::hidden('no',base64_encode($order_no)) !!}
    {!! Form::hidden('host',base64_encode($host->id)) !!}
    {!! Form::submit('立即续费',["class"=>"buy-btn"]) !!}
    {!!  Form::close() !!}
@endif

