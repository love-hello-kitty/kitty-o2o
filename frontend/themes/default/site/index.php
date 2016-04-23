<?php use frontend\assets\AppAsset;
AppAsset::addCss($this,'@web/themes/default/css/map.css');AppAsset::addCss($this,'@web/themes/default/css/bmap_autocomplete.css');AppAsset::addScript($this,Yii::$app->params['lbsyun']['web_map_api'],3);AppAsset::addScript($this,'@web/themes/default/js/site.js');?><div class="top-banner">  <div class="background m-shadow"></div>  <div class="logo fl"><img src=""></div>  <div class="userbar fr">    <div id="is-login" class="top-loginbar fl">      <span class="fl top-loginbar-username">欢迎你，周星星</span>      <i class="icon i-top-yarrow"></i>      <ul class="login-menu">        <li><a class="wrap" href="">我的外卖订单</a></li>        <li><a class="wrap" href="">我的收藏夹</a></li>        <li><a class="wrap" href="">我的优惠券</a></li>        <li><a class="wrap" href="" id="logout">退出</a></li>      </ul>    </div>  </div></div><div class="map" id="map">  <div class="top">    <!-- 引导显示图标 -->    <div class="guider" style="visibility: visible;" id="guider">      <div class="bg">        <a href="javascript:;" class="cross" id="tipclose"></a>        <div class="title clearfix">          <span class="s-1">1.选城市</span>          <span class="s-2">2.搜位置</span>          <span class="s-3">3.叫外卖</span>          <span class="s-4">4.享美食</span>          <span class="s-5">5.来评价</span>        </div>        <div class="choose-city"></div>        <div class="choose-poi"></div>        <div></div>      </div>    </div>    <!-- 输入具体的地址调用地图接口 -->    <div class="address clearfix" id="address">      <div class="fr history-address m-shadow">        <a id="historylist" href="javascript:;" title="历史地址">          <span>历史地址</span>          <i class="i-triangle-down"></i>        </a>        <script type="text/template" id="historyData"></script>      </div>      <div class="fl current-city m-shadow">        <a href="javascript:;" class="city" id="citylist" data-ispoi="1" data-cid="320100">          <span>            南京          </span>          <i class="i-triangle-down"></i>        </a>      </div>      <div class="fl address-input">        <div class="input-container clearfix m-shadow">          <input type="text" id="searchKeywords" placeholder="输入地址搜索周边美食" class="fl" autocomplete="off">          <a href="javascript:;" class="fl" id="search">搜索</a>        </div>      </div>    </div>  </div>  <div class="result hidden" id="result" style="overflow: hidden; padding: 0px; height: 793px; width: 300px;">    		<div class="jspContainer" style="width: 300px; height: 793px;">  			<div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 300px;">  				<div class="loading"></div>  			</div>  		</div>  </div>  <div class="container hidden" id="bd-map">  </div></div><div id="map-footer" class="map-footer">  <div class="map-footer-entry">    <a class="map-footer-link" href="###" target="_blank" rel="nofollow">手机版下载</a>    <i class="map-footer-separator">|</i>    <a class="map-footer-link" href="###" target="_blank" rel="nofollow">关注微博</a>    <i class="map-footer-separator">|</i>    <a class="map-footer-link map-footer-weixing" href="javascript:;" rel="nofollow">关注微信<img class="map-footer-weixingpic" src=""></a>    <i class="map-footer-separator">|</i>    <a class="map-footer-link kaidian_address" href="http://kaidian.waimai.meituan.com/?source=1" target="_blank" rel="nofollow">我要开店</a>    <i class="map-footer-separator">|</i>    <a class="map-footer-link" href="http://waimai.meituan.com/help/banma" target="_blank" rel="nofollow">配送合作申请</a>  </div>  <div class="map-footer-copyright">©2016 jiafei.com <a target="_blank" href="http://www.miibeian.gov.cn/" rel="nofollow">京ICP证070791号</a> 京公网安备11010502025545号</div></div>