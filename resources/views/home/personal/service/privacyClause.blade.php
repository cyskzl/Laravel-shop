@extends('home.layouts.layout')

@section('title','隐私条款')

@section('style')
	<link rel="stylesheet" href="{{asset('/templates/home/css/personal.css')}}"/>
	<style>
		.terms-content{  padding: 21px;  font-size: 12px;  line-height: 1.6;  color: #9e9e9e;  }
	</style>
@endsection

@section('main')
	<!-- 内容 -->
	    <!-- breadcrumbs start-->
	    <div class="breadcrumbs comWidth">
	        <ul>
	            <li><a href="javascript:;">首页</a><span>&gt;</span></li>
	            <li><a href="javascript:;">个人中心</a><span>&gt;</span></li>
	            <li><a href="javascript:;">隐私条款</a></li>
	        </ul>
	    </div>
	    <!-- breadcrumbs end-->

	    <!-- personal_center start-->
	    <div class="personal_center comWidth clearfix">

			@include('home.personal.left_memu')

	        <div class="personal_main fr">
	            <ul class="personal_tab_header clearfix">
					<li style="border-left: none"><a href="{{ url('home/newest') }}" data-memu="13">最新消息</a></li>
	                <li><a href="{{ url('home/comproblem') }}" data-memu="14">常见问题</a></li>
	                <li><a href="{{ url('home/usermanual') }}" data-memu="15">用户手册</a></li>
	                <li class="on"><a href="{{ url('home/privacyclause') }}" data-memu="16">隐私条款</a></li>
	            </ul>

	            <!-- 隐私条款 -->
	            <div class="personal_tab">
	                <div class="terms-content">
	                    <p>隐私条款</p>
	                    <p><strong>Wconcept承诺尊重您的隐私和您的个人信息安全。</strong></p>
	                    <br/>
	                    <p>一、Wconcept并且承诺尽可能地为您提供最佳的服务。比如，Wconcept会利用通过APP运作而收集到的这些信息， 来制定您的个性化沟通方式和购物经历、也可以更好地对您的客户服务调查做出反应、对您的订单和帐户信息及客户服务需求与您进行沟通、就Wconcept中的商品和活动与您进行沟通以及为了其他推广宣传目的、优化管理、促销、调查等其他本网站的特别项目使用这些信息。Wconcept也可以用这样的信息来阻止 可能的被禁止项目和非法活动，用以加强使用规则和条款的实施，并用以解决争议和保护其合法的私有财产权益及解决涉及Wconcept的交易活动而产生的问题。</p>
	                    <br/>
	                    <p>二、Wconcept不可以向任何其他人出售或出租您的个人信息。但如果是为经营目的需要的，Wconcept可以将信息交付给一些服务提供商只在为Wconcept的经营来使 用。例如，他们负责处理Wconcept的装运业务、数据管理业务、电子邮件发送业务、市场调查业务、信息分析业务和促销管理业务。买卖Wconcept上的商品， 查阅数据资料、销售信函、市场调查、分析报告和促销手段。Wconcept提供给其服务提供商的个人信息的前提是他们需要这些信息来完成其服务并同时承诺尽可 能保护您的个人信息。</p>
	                    <br/>
	                    <p>三、在极少数情况下，Wconcept可以透露特定的信息，例如，政府机构请求、法院调查令等法律规定的情况，以及为执行本网站的政策或保护他人的权益、财产 和安全。Wconcept也会和那些协助进行诈骗防范和调查的公司共享信息。下在法律范围内响应法院指令，以便加强本网站的管理政策或保护他人的权利、财产或 保险。Wconcept同时与公司分享信息协助保护或调查。Wconcept不会提供信息给那些推销和商业目的公司或代理机构行。</p>
	                    <br/>
	                    <p>四、Wconcept会将非常认真地保护您的个人信息。然而，尽管Wconcept已经尽力了，但是仍有第三方通过非法手段在中途截取发送的信息的风险。这在所有互联网 使用中都是真实存在的。以至于Wconcept无法完全保证您传送的任何信息的安全。发送任何信息的风险都您都须承担。特别是，Wconcept将采取所有合理的预防措 施来确保您的订购和付款详细信息的安全，除非Wconcept存在疏忽，否则Wconcept将不承担因您提供的信息被非法侵入而造成您和第三方的相应损失。</p>
	                    <br/>
	                    <p>五、Wconcept决不会发送电子邮件来向您索要登录帐户和密码。如果您接收了这样的电子邮件，绝对不要回复。</p>
	                </div>
	            </div>
	            <!-- 隐私条款 -->
	        </div>

	    </div>
	    <!-- personal_center end-->
@endsection

@section('shop')
	<div class="cart">
		<a href="">
			<i></i>
			<p>购物车</p>
			<b>0</b>
		</a>
	</div>
	<!--回到顶部-->
	<div id="scrolltop">
		<img src="{{asset('/templates/home/uploads/go_to_top.png')}}" alt=""  >
	</div>
@endsection
@section('js')
	<script src="{{asset('/templates/home/js/dynamic.js')}}"></script>
	<script src="{{asset('/templates/home/js/left_memu.js')}}"></script>
@endsection
