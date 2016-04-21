<?php 
use frontend\assets\AppAsset;
AppAsset::addCss($this,'@web/themes/default/css/home.css');
?>  
	  <div class="triffle" id="triffle">
        <div class="stick-qrcode hidden" id="stickQrcode">
          <a class="index-xiaomei qrcode" href="http://waimai.meituan.com/mobile/download/default" target="_blank">
            <i class="icon i-qrcode-cross"></i>
            <span class="code qrcode"></span>
          </a>
        </div>

	    <a href="javascript:;" class="top" style="display: none;"><i class="icon i-backtop"></i></a>
	    <a id="aside-feedback" target="_blank" href="http://waimai.meituan.com/help/feedback" class="fb">意见反馈</a>
	  </div>
	  <div class="wrapper">
	      <div id="top-tips" class="top-tips" style="display: none;">
	        <a class="j-top-tips-close top-tips-close" href="javascript:;"><i class="icon i-top-tips-close"></i></a>
	        <div class="j-top-tips-content top-tips-content" data-id=""></div>
	      </div>
  	  <div class="page-header">
        <div class="top-nav">
          <div class="topnav-wrap">
            <div class="fr welcome">
    <span id="dis-login" class="top-disloginbar fl"><a class="j-register fl" href="http://passport.meituan.com/account/unitivesignup?service=waimai&continue=http%3A%2F%2Fwaimai.meituan.com%3A80%2Faccount%2Fsettoken%3Fcontinue%3Dhttp%253A%252F%252Fwaimai.meituan.com%252Fhome%252Fwtsrzsqy049m" rel="nofollow">注册</a><a class="j-login fr" href="http://passport.meituan.com/account/unitivelogin?service=waimai&continue=http%3A%2F%2Fwaimai.meituan.com%3A80%2Faccount%2Fsettoken%3Fcontinue%3Dhttp%253A%252F%252Fwaimai.meituan.com%252Fhome%252Fwtsrzsqy049m" rel="nofollow">登录</a>｜ </span>
              <a href="http://waimai.meituan.com/mobile/download/default" class="wap fl" rel="nofollow"><i class="icon i-top-mobile"></i><span>手机版</span></a>
              <a target="_blank" href="http://meituan.com/" class="site-name fl"><i class="icon i-top-tuan"></i><span>美团网</span></a>
            </div>


            <i class="fl icon i-top-loc"></i>
              <span class="current-city fl" id="current-city">南京</span>
              <span class="address fl" id="address">
                <span id="curr-location" class="current-address fl">惠安堂大药房(集群路店)</span>
                <div class="change fl clearfix" id="changePosition">
                  <a href="http://waimai.meituan.com/?stay=1" class="change-link">
                    <span class="fl">[切换地址]</span>
                      <i class="icon i-top-yarrow"></i>
                  </a>
                    <ul>
                          <li>
                            <a class="wrap clearfix" href="http://waimai.meituan.com/geo/geohash?lat=32.30895286425948&lng=118.87754268944263&addr=%25E9%25BE%2599%25E8%2599%258E%25E8%2590%25A5&from=m" title="龙虎营">
                              <i class="icon i-hisbar-timer fl"></i>
                              <div class="na fl">                  龙虎营
                  
</div>
                            </a>
                          </li>
                          <li>
                            <a class="wrap clearfix" href="http://waimai.meituan.com/geo/geohash?lat=26.254460960626602&lng=105.95520883798599&addr=%25E6%259C%25AA%25E7%259F%25A5&from=m" title="未知">
                              <i class="icon i-hisbar-timer fl"></i>
                              <div class="na fl">                  未知
                  
</div>
                            </a>
                          </li>
                        <li>
                          <a class="wrap clearfix" href="http://waimai.meituan.com/?stay=1" title="换至新地址">
                            <i class="icon i-hisbar-cy fl"></i><div class="na fl">换至新地址</div>
                          </a>
                        </li>
                    </ul>
                </div>
              </span>
            
          </div>
        </div>
        <div class="middle-nav">
          <div class="middlenav-wrap clearfix">
            <h1 class="logo fl">
              <a href="http://waimai.meituan.com/" title="美团外卖"><img src="./美团外卖_files/normal-new2.png" alt="美团外卖"></a>
            </h1>
            <div class="desire fl">
              <a href="http://waimai.meituan.com/" class="ca-lightgrey"><span>首页</span></a>
              <span class="vertical-line">|</span>
              <a href="http://waimai.meituan.com/customer/order/list" class="ca-lightgrey" rel="nofollow"><span>我的外卖</span></a>
              <span class="vertical-line">|</span>
              <a href="http://waimai.meituan.com/contact/contactus" class="ca-lightgrey"><span>加盟合作</span></a>
            </div>
            <div class="search-box fr">
              <input type="text" class="header-search fl" placeholder="搜索商家，美食">
              <a href="javascript:;" class="doSearch fr">搜索</a>
              <div class="result-box">
                <div class="result-left fl">
                  <div class="rest-words ct-black">餐厅</div>
                  <div class="food-words ct-black">美食</div>
                </div>
                <div class="result-right fl">
                  <ul class="rest-lists">
                  </ul>
                  <div class="line"></div>
                  <ul class="food-lists">
                  </ul>
                </div>
              </div>
              <div class="no-result">
                没有找到相关结果，请换个关键字搜索！
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="page-wrap">
        <div class="inner-wrap">



  







<script id="page-data-template" type="text/template">
  {"page":  "home"
  }
  </script>

<div class="inner-bg">

  

    <div class="rest-banner">
      <div class="imgsort-wrapper">
        <span class="imgsort-filter-title">商家分类</span>
        <ul class="clearfix imgsort-content">
          <li class="fl selected">
            <a href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0" class="imgsort-list" title="全部">
              <span class="imgsort-info">全部</span>
            </a>
          </li>
            <li class="fl ">
              <a class="imgsort-list" title="西餐" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_17&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">西餐</span>
              </a>
            </li>
            <li class="fl ">
              <a class="imgsort-list" title="甜点饮品" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_19&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">甜点饮品</span>
              </a>
            </li>
            <li class="fl ">
              <a class="imgsort-list" title="鲜花蛋糕" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_23&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">鲜花蛋糕</span>
              </a>
            </li>
            <li class="fl ">
              <a class="imgsort-list" title="快餐小吃" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_10&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">快餐小吃</span>
              </a>
            </li>
            <li class="fl ">
              <a class="imgsort-list" title="火锅" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_11&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">火锅</span>
              </a>
            </li>
            <li class="fl">
              <a class="imgsort-list" title="海鲜/烧烤" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_12&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">海鲜/烧烤</span>
              </a>
            </li>
            <li class="fl ">
              <a class="imgsort-list" title="地方菜" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_15&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="imgsort-info">地方菜</span>
              </a>
            </li>
        </ul>
      </div>
        <div class="rest-filter clearfix">
          <span class="rest-filter-title">优惠筛选</span>
              <a title="下单立减" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=fulldiscount|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="sprite checkbox "></span>
                <span class="txt">    下单立减
    
</span>
              </a>
              <a title="下单赠饮料" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=fulldonation|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="sprite checkbox "></span>
                <span class="txt">    下单赠饮料
    
</span>
              </a>
              <a title="新用户优惠" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=firstdiscount|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="sprite checkbox "></span>
                <span class="txt">    新用户优惠
    
</span>
              </a>
              <a title="支持发票" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=invoice|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">
                <span class="sprite checkbox "></span>
                <span class="txt">    支持发票
    
</span>
              </a>

            <a title="在线支付" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=1&support_logistic=0">
              <span class="sprite checkbox "></span>
              <span class="txt">在线支付</span>
            </a>


            <a title="美团专送" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=1">
              <span class="sprite checkbox "></span>
              <span class="txt">美团专送</span>
            </a>
        </div>
      <div class="divider"></div>
      <div class="sort-filter" id="sortFilter">
        <a class="sort default-sort active" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">默认排序</a>
        <a class="sort sa-sort " href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=1&support_invoice=0&support_online_pay=0&support_logistic=0">销量<i class="icon i-orderdown"></i></a>
        <a class="sort ct-sort " href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=2&support_invoice=0&support_online_pay=0&support_logistic=0">评价<i class="icon i-orderdown"></i></a>
        <a class="sort ti-sort " href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=3&support_invoice=0&support_online_pay=0&support_logistic=0">送餐速度<i class="icon i-orderup"></i></a>
        <div class="fl clearfix">
          <span class="fl label">起送价筛选</span>
          <div class="prices">
            <a class="all" href="javascript:;">
              全部商家<i class="icon i-triangle-dn"></i>
            </a>
            <ul>
              <li><a class="selected" href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=0&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">全部商家</a></li>
              <li><a href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=1&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">10元以下</a></li>
              <li><a href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=2&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">20元以下</a></li>
              <li><a href="http://waimai.meituan.com/home/wtsrzsqy049m?classify_type=|cate_all&price_type=3&sort_type=0&support_invoice=0&support_online_pay=0&support_logistic=0">30元以下</a></li>
            </ul>
          </div>
        </div>
         
              </div>
    </div>
  <div class="rest-list">
    <ul class="list clearfix">
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="宽窄巷子" data-bulletin="" data-poiid="730227" class="restaurant" data-all="1" data-firstdiscount="1" data-fulldiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/730227?pos=0" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="730227" data-index="0" class="scroll-loading" src="./美团外卖_files/41a51019daf822896ba9cc668b5a5f2016595.jpg" data-src="http://p1.meituan.net/208.0/xianfu/41a51019daf822896ba9cc668b5a5f2016595.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="宽窄巷子">
    宽窄巷子
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 68px"></span>
  	              </span>
                  <span class="score-num fl">4.7分</span>
  	              <span class="total cc-lightred-new fr">
月售98单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      30分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减9元<span class="special">(手机客户端专享)</span></script>


                  <i class="icon i-minus"></i>
                <script type="text/template" data-icon="i-minus">
                  满30元减1元;满50元减2元;满100元减4元<span class="special">(手机客户端专享)</span>
                </script>








            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="730227" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="如意馄饨" data-bulletin="" data-poiid="767283" class="restaurant" data-all="1" data-firstdiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/767283?pos=1" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="767283" data-index="1" class="scroll-loading" src="./美团外卖_files/fc862361ae8f4268c1c56b83383d7d3b18432.jpg" data-src="http://p0.meituan.net/208.0/xianfu/fc862361ae8f4268c1c56b83383d7d3b18432.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="如意馄饨">
    如意馄饨
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 70px"></span>
  	              </span>
                  <span class="score-num fl">4.8分</span>
  	              <span class="total cc-lightred-new fr">
月售101单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      30分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减7元<span class="special">(手机客户端专享)</span></script>










            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="767283" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="苗乡米线" data-bulletin="" data-poiid="755879" class="restaurant" data-all="1" data-firstdiscount="1" data-fulldiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/755879?pos=2" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="755879" data-index="2" class="scroll-loading" src="./美团外卖_files/2337e99b274c02ab92967d9ba40854c4215364.jpg" data-src="http://p1.meituan.net/208.0/xianfu/2337e99b274c02ab92967d9ba40854c4215364.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="苗乡米线">
    苗乡米线
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 66px"></span>
  	              </span>
                  <span class="score-num fl">4.5分</span>
  	              <span class="total cc-lightred-new fr">
月售263单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      30分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减9元<span class="special">(手机客户端专享)</span></script>


                  <i class="icon i-minus"></i>
                <script type="text/template" data-icon="i-minus">
                  满25元减1元;满50元减2元<span class="special">(手机客户端专享)</span>
                </script>








            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="755879" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
 
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="润为坊香菇鸡米饭" data-bulletin="" data-poiid="658135" class="restaurant" data-all="1" data-firstdiscount="1" data-fulldiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/658135?pos=7" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="658135" data-index="7" class="scroll-loading" src="./美团外卖_files/88e0a4e821336ab8def8248adfaff592318575.jpg" data-src="http://p1.meituan.net/208.0/xianfu/88e0a4e821336ab8def8248adfaff592318575.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="润为坊香菇鸡米饭">
    润为坊香菇鸡米饭
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 68px"></span>
  	              </span>
                  <span class="score-num fl">4.7分</span>
  	              <span class="total cc-lightred-new fr">
月售297单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      37分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减8元<span class="special">(手机客户端专享)</span></script>


                  <i class="icon i-minus"></i>
                <script type="text/template" data-icon="i-minus">
                  满21元减5元;满30元减10元;满50元减15元<span class="special">(手机客户端专享)</span>
                </script>








            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="658135" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
          <li class="rest-separate j-rest-separate"></li>
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="粥当家" data-bulletin="夏季来临，粥当家新增凉皮，凉面，欢迎新老客户品尝，下单时请注明是否需要香菜和辣油!早上九点之前如需送早餐请拨电话…!垂询热线~18112957880" data-poiid="424969" class="restaurant" data-all="1" data-firstdiscount="1" data-fulldiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/424969?pos=8" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="424969" data-index="8" class="scroll-loading" src="./美团外卖_files/0a95b6c4c0448d51cbb6b4761e8cd6e5167741.jpg" data-src="http://p0.meituan.net/208.0/xianfu/0a95b6c4c0448d51cbb6b4761e8cd6e5167741.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="粥当家">
    粥当家
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 70px"></span>
  	              </span>
                  <span class="score-num fl">4.8分</span>
  	              <span class="total cc-lightred-new fr">
月售785单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      37分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减8元<span class="special">(手机客户端专享)</span></script>


                  <i class="icon i-minus"></i>
                <script type="text/template" data-icon="i-minus">
                  满21元减2元;满30元减4元<span class="special">(手机客户端专享)</span>
                </script>








            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="424969" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="杨铭宇黄焖鸡米饭" data-bulletin="请大家尽量避开点餐高峰期，这样的话可能稍早收到餐，如果收到餐有问题，请打15358168088询问，我们会很好的为您解决！" data-poiid="406992" class="restaurant" data-all="1" data-firstdiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/406992?pos=9" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="406992" data-index="9" class="scroll-loading" src="./美团外卖_files/9ecd67731ea5839ade110935ff03e44497660.jpg" data-src="http://p1.meituan.net/208.0/xianfu/9ecd67731ea5839ade110935ff03e44497660.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="杨铭宇黄焖鸡米饭">
    杨铭宇黄焖鸡米饭
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 67px"></span>
  	              </span>
                  <span class="score-num fl">4.6分</span>
  	              <span class="total cc-lightred-new fr">
月售733单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥5
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      39分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减9元<span class="special">(手机客户端专享)</span></script>










            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="406992" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition ">
      <div data-title="士百士汉堡店" data-bulletin="" data-poiid="755356" class="restaurant" data-all="1" data-firstdiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/755356?pos=10" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="755356" data-index="10" class="scroll-loading" src="./美团外卖_files/70bc1e859edb71b6ccd52c92a0887b38345915.jpg" data-src="http://p0.meituan.net/208.0/xianfu/70bc1e859edb71b6ccd52c92a0887b38345915.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="士百士汉堡店">
    士百士汉堡店
    
                </span>
              </div>
  		          <div class="rank clearfix">
  	              <span class="star-ranking fl">
  	                <!-- 5颗星60px长度，算此时星级的长度 -->
  	                <!-- 算出空白填充的部分长度 -->
  	                <span class="star-score" style="width: 62px"></span>
  	              </span>
                  <span class="score-num fl">4.2分</span>
  	              <span class="total cc-lightred-new fr">
月售62单
  	              </span>
  		          </div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      50+分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减7元<span class="special">(手机客户端专享)</span></script>










            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="755356" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
       
          
        <li class="fl rest-li">  	<div class="j-rest-outer rest-outer transition rest-mask">
      <div data-title="祁家菜馆" data-bulletin="" data-poiid="846374" class="restaurant" data-all="1" data-firstdiscount="1" data-minpricelevel="2">
        <a class="rest-atag" href="http://waimai.meituan.com/restaurant/846374?pos=53" target="_blank">
          <div class="top-content">
            <div class="preview">
              <img data-rid="846374" data-index="53" class="scroll-loading" src="./美团外卖_files/b47b628c5144c91f499ee99cfce4bcbc545028.jpg" data-src="http://p1.meituan.net/208.0/xianfu/b47b628c5144c91f499ee99cfce4bcbc545028.jpg" data-max-width="208" data-max-height="156" style="width: 208px; height: 156px;">
              <div class="rest-tags">
              </div>
            </div>
            <div class="content">
              <div class="name">
                <span title="祁家菜馆">
    祁家菜馆
    
                </span>
              </div>
                  <div class="outof-sale">休息中，不接受订单</div>
              <div class="price">
                <span class="start-price">起送:￥20</span>
                <span class="send-price">
                  配送费:￥4
                </span>
                <span class="send-time"><i class="icon i-poi-timer"></i>
                      50+分钟
                </span>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="others">
            <div class="discount">
                  <i class="icon i-delivery"></i>
                  <script type="text/template" data-icon="i-delivery">由美团专送提供专业高品质送餐服务</script>

                  <i class="icon i-pay"></i>
                <script type="text/template" data-icon="i-pay">该商家支持在线支付</script>

              <!-- 是否支持代金券 -->





                  <i class="icon i-first"></i>
                <script type="text/template" data-icon="i-first">新用户首次下单,立减13元<span class="special">(手机客户端专享)</span></script>










            </div>
          </div>
        </a>
        <a href="javascript:;" class="un-favorite j-save-up" data-poiid="846374" title="收藏商家">
          <i class="icon i-poi-fav1"></i>
        </a>
    </div>
    </div>
</li>
    </ul>
  </div>

</div>

      </div>
    </div>
    <div class="page-footer">
      <div class="footer-wrap">
        <div class="column fl help">
          <div class="title">用户帮助</div>
          <ul>
            <li><a href="http://waimai.meituan.com/help/faq" class="ca-darkgrey" target="_blank" rel="nofollow">常见问题</a></li>
            <li><a href="http://waimai.meituan.com/help/feedback" class="ca-darkgrey" target="_blank" rel="nofollow">用户反馈</a></li>
            <li><a href="http://waimai.meituan.com/help/inform" class="ca-darkgrey" target="_blank" rel="nofollow">诚信举报</a></li>
            <li><a href="http://waimai.meituan.com/restaurant/0" class="ca-darkgrey" target="_blank" rel="nofollow">线上体验店</a></li>
          </ul>
        </div>
        <div class="column fl update">
          <div class="title">获取更新</div>
          <ul>
            <li><a href="http://waimai.meituan.com/mobile/download/default" class="ca-darkgrey" target="_blank" rel="nofollow">iPhone/Android</a></li>
            <li><a href="http://e.weibo.com/u/3949575070" class="ca-darkgrey" target="_blank" rel="nofollow">美团外卖新浪微博</a></li>
            <li><span class="ct-darkgrey">公众微信号：美团外卖</span></li>
          </ul>
        </div>
        <div class="column fl corp">
          <div class="title">商务合作</div>
          <ul>
            <li><a href="http://kaidian.waimai.meituan.com/?source=1" class="ca-darkgrey kaidian_address" target="_blank" rel="nofollow">我要开店</a></li>
            <li><a href="http://waimai.meituan.com/help/banma" class="ca-darkgrey" target="_blank" rel="nofollow">配送合作申请入口</a></li>
            <li><a href="http://waimai.meituan.com/help/agent" class="ca-darkgrey" target="_blank" rel="nofollow">城市代理商申请入口</a></li>
          </ul>
        </div>
        <div class="column fl info">
          <div class="title">公司信息</div>
          <ul>
            <li><a href="http://www.meituan.com/about/" class="ca-darkgrey" target="_blank" rel="nofollow">关于美团</a></li>
            <li><a href="http://www.meituan.com/about/press" class="ca-darkgrey" target="_blank" rel="nofollow">媒体报道</a></li>
            <li><a href="http://waimai.meituan.com/help/job" class="ca-darkgrey" target="_blank" rel="nofollow">加入我们</a></li>
          </ul>
        </div>
        <div class="column fr service">
          <div><i class="icon i-service-avatar"></i></div>
          <div class="details">
            <p class="w1">美团外卖客服电话</p>
            <p class="w2">4008507777</p>
            <!-- <p class="w2">4008508888</p> -->
            <!-- <p class="w2">010-56652722</p> -->

              <p class="w3">周一到周日 9:00-23:00</p>

            <p class="w3">客服不受理商务合作</p>
          </div>
        </div>
        <div class="clear"></div>
        <div class="copyright">©2015 meituan.com <a target="_blank" href="http://www.miibeian.gov.cn/">京ICP证070791号</a> 京公网安备11010502025545号</div>
        <div class="sp-ft">
          <a target="_blank" title="备案信息" href="http://www.hd315.gov.cn/beian/view.asp?bianhao=010202011122700003" class="record"></a>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript" data-main="http://xs01.meituan.net/waimai_web/js/page/home_64a8980b" src="./美团外卖_files/r.js"></script>

	

<div class="ceiling-search" style="display: none; top: -58px;"><div class="ceiling-inner clearfix">  <a href="http://waimai.meituan.com/" class="fl ceiling-logo">    <img src="./美团外卖_files/ceiling-logo2.png" alt="美团外卖">  </a>  <div class="search-box fl">    <input type="text" id="header-search" class="header-search fl" value="搜索商家，美食">    <a href="javascript:;" class="doSearch fr">搜索</a>    <div class="result-box">      <div class="result-left fl">        <div class="rest-words ct-black">商家</div>        <div class="food-words ct-black">美食</div>      </div>      <div class="result-right fl">        <ul class="rest-lists">        </ul>        <div class="line"></div>        <ul class="food-lists">        </ul>      </div>    </div>    <div class="no-result">      没有找到相关结果，请换个关键字搜索！    </div>  </div></div></div>