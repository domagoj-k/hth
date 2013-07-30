<?php
defined('_JEXEC') or die;
$doc = JFactory::getDocument();

  //$doc->addFavicon('templates/' . $this->template . '/favicon.ico' );
$doc->addStyleSheet('templates/' . $this->template . '/css/system.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/general.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/template_css.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/suckerfish.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/joomla_classes.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/typography.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/gk_stuff.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/style1.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/dark.css');


//$doc->addScript('/templates/' . $this->template . '/js/main.js', 'text/javascript');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
  <jdoc:include type="head" />

</head>
<body bgcolor="#ffffff" bottommargin="0" rightmargin="0" leftmargin="0" topmargin="0">
<div id="bg" align="center">
  <div id="wrapper">
    <div id="header_bg">
    <div id="header">
      <div id="header_layout">
        <div id="header_left">
          <div id="mylogo"><img  alt="HTH" width="65%" height="65%" src="images/logo1.jpg"></div>
        </div>
        <div id="header_right">
          <div share_layout>
          <div id="share">
            <div id="lang"><jdoc:include type="modules" name="top" /></div>


            <div id="skype"><a href="callto://hthinfo/" target="_blank"><img alt="skype" width="25px" height="25px" src="images/icon/skype.jpg" ></a></div>
            <div id="fb"><a href="http://facebook.com" target="_blank"><img alt="fb" width="25px" height="25px" src="images/icon/fb.jpg" ></a></div>
            <div id="twitter"><a href="http://twitter.com" target="_blank"><img alt="twitter" width="25px" height="25px" src="images/icon/twitter.jpg" ></a></div>
            <!--
            <div id="rss"><a href="#"><img alt="rss" width="25px" height="25px" src="images/icon/rss.jpg" ></a></div>
            -->
            <div id="youtube"><a href="http://youtube.com" target="_blank"><img alt="rss" width="25px" height="25px" src="images/icon/youtube.jpg" ></a></div>

            <!--
            <div id="skype"><a href="callto://hthcom/" target="_blank"><img alt="skype" width="70%" height="70%" src="images/icon/skype.jpg" ></a></div>
            <div id="fb"><a href="http://facebook.com" target="_blank"><img alt="fb" width="70%" height="70%" src="images/icon/fb.jpg" ></a></div>
            <div id="twitter"><a href="http://twitter.com" target="_blank"><img alt="twitter" width="70%" height="70%" src="images/icon/twitter.jpg" ></a></div>
            <div id="youtube"><a href="http://youtube.com" target="_blank"><img alt="youtube" width="70%" height="70%" src="images/icon/youtube.jpg" ></a></div>
            -->

          </div>
          </div>

          <div id="my_search_layout">
            <div id="my_search">
              <jdoc:include type="modules" name="search" />
            </div>
          </div>


          <div id="main_menu">
            <jdoc:include type="modules" name="footer_menu" />
          </div>
        </div>
        <div class="vide"></div>
      </div>
      </div>

    </div>

    <?php
    $menu = & JSite::getMenu();
    if ($menu->getActive() == $menu->getDefault()) {?>
      <div id="banner_big">
        <div id="banner_img" align="left">
          <?php if($this->countModules('header1')) : ?>
          <div id="header1" class="clearfix">
            <jdoc:include type="modules" name="header1" style="raw" />
          </div>
          <?php endif; ?>
        </div>

        <div id="banner_link_layout">
          <div id="banner_link" align="center">
            <jdoc:include type="modules" name="user2" />
          </div>
        </div>
      </div>

    <?php } if ($menu->getActive() != $menu->getDefault()) {?>

      <div id="banner_small_bg">
        <div id="banner_small">
          <div id="banner_small_img">
            <?php if($this->countModules('header2')) : ?>
            <div id="header2" class="clearfix">
              <jdoc:include type="modules" name="header2"  />
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div id="content_layout1">
        <div id="content_layout">
          <div id="my_content">
            <?php if($this->countModules('left')) {?>
            <div id="body_left" align="left">
              <div id="left" class="clearfix">
                <jdoc:include type="modules" name="left" style="xhtml" />
              </div>

            </div>
            <?php
            $widthContent= '680';}
            else
              {$widthContent= '1000';}
            ?>
            <div id="body_main">
              <div id="contents" align="left" style="width:<?php echo $widthContent; ?>px">
                <jdoc:include type="component" />
              </div>
            </div>
            <div class="vide"></div>
          </div>
        </div>
      </div>

    <?php } ?>

    <div id="footerl_bg">
    <div id="footerl">
        <div id="footerl_left"></div>
        <div id="menu1"><jdoc:include type="modules" name="user3" /></div>
        <div id="icon_top"><a href="#top"><img alt="go top" src="images/top.png"></a></div>
        <div class="vide"></div>
    </div>
    </div>

    <div id="footer_bg">
      <div id="footer">
        <div id="footer_layout">
          <div id="footer_left">
            <div id="copyright">
              <p>Copyright 2012 HTH, All Rights Reserved</p>
            </div>
          </div>
          <div id="footer_right">


            <div id="com_share">
              <div id="company_name">
                <jdoc:include type="modules" name="tab1" />
              </div>
              <!--
              <div id="share_footer">
                <div id="skype"><a href="callto://ldbminh/" target="_blank"><img alt="skype" width="70%" height="70%" src="images/icon/skype.jpg" ></a></div>
                <div id="fb"><a href="http://facebook.com" target="_blank"><img alt="fb" width="70%" height="70%" src="images/icon/fb.jpg" ></a></div>
                <div id="twitter"><a href="http://twitter.com" target="_blank"><img alt="twitter" width="70%" height="70%" src="images/icon/twitter.jpg" ></a></div>
                <div id="youtube"><a href="http://youtube.com" target="_blank"><img alt="youtube" width="70%" height="70%" src="images/icon/youtube.jpg" ></a></div>
              </div>
              -->
            </div>

            <div id="company_info" align="left">
              <div id="adress" align="center">
                <jdoc:include type="modules" name="tab2" />
              </div>
              <div id="phone">
                <jdoc:include type="modules" name="tab3" />
              </div>
              <div class="vide"></div>
            </div>
          </div>
          <div class="vide"></div>
        </div>
      </div>
    </div>
    </div>

</div>
<jdoc:include type="modules" name="debug" />


</body>
</html>