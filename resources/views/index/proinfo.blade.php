@extends('layouts.shop')
@section('title', '详情页面')
@section('content')
   <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if($gory->g_imgs)
      @php $g_imgs=explode('|',$gory->g_imgs); @endphp
      @foreach($g_imgs as $v)
      <img src="{{env('UPLOADS_URL')}}{{$v}}" />
      @endforeach
     @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$gory->g_price}}</strong>
        当前页面访问量为：{{$count}}
       </th>
       <td>
        <input type="text" class="spinnerExample"/>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$gory->g_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      {{$gory->g_desc}}
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcart" href="javascript:;void(0)">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
        
  @include('index.public.footer');
<script>
  $("#addcart").click(function(){
    var g_id={{$gory->g_id}};
    var buy_number=$('.spinnerExample').val();
    if(buy_number<1){
      alert('请更改购买数量！');
      return;
    }
    $.ajaxSetup({headers:{ 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}})
    $.post('/addcart',{g_id:g_id,buy_number:buy_number},function(result){
      if(result.code=='00003'){
        location.href='/log?refer='+location.href;
      }
      if(result.code=='00004'){
        alert(result.msg);
        return;
      }
      if(result.code=='00000'){
        location.href='/car';
        alert(result.msg);
      }
    },'json')
  })
</script>
  @endsection