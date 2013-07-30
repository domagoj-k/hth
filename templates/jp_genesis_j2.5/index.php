<?php
/**
* @copyright Copyright (C) 2012 JoomlaPraise. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<?php
$app = JFactory::getApplication();
// set custom template theme for user
$user = &JFactory::getUser();
if( !is_null( JRequest::getCmd('templateTheme', NULL) ) ) {
    $user->setParam($this->template.'_theme', JRequest::getCmd('templateTheme'));
    $user->save(true);
}
if($user->getParam($this->template.'_theme')) {
    $this->params->set('templateTheme', $user->getParam($this->template.'_theme'));
}
?>
<jdoc:include type="head" />
<?php if($this->params->get('headingFontFamily') == "pt_sans_narrow") { ?>
  <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700' rel='stylesheet' type='text/css'>
<?php } ?>
<?php if($this->params->get('fontFamily') == "pt_sans") { ?>
  <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<?php } ?>
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/<?php echo $this->params->get('templateTheme'); ?>.css" type="text/css" />
<style type="text/css">
<?php if($this->params->get('fontFamily') == "pt_sans") { ?>
body{font-family:"PT Sans",Arial, Helvetica, sans-serif;}
<?php } elseif($this->params->get('fontFamily') == "times") { ?>
body{font-family:"Times New Roman", Times, serif;}
<?php } elseif($this->params->get('fontFamily') == "courier") { ?>
body{font-family:"Courier New", Courier, monospace;}
<?php } elseif($this->params->get('fontFamily') == "georgia") { ?>
body{font-family:Georgia,"Times New Roman", Times, serif;}
<?php } elseif($this->params->get('fontFamily') == "arial") { ?>
body{font-family:Arial, Verdana, sans-serif;}
<?php }?>
<?php if($this->params->get('headingFontFamily') == "pt_sans_narrow") { ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{font-family:"PT Sans Narrow", Georgia, "Times New Roman", Times, serif;}
<?php } elseif($this->params->get('headingFontFamily') == "arial") { ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{font-family:Arial, Helvetica, sans-serif;}
<?php } elseif($this->params->get('headingFontFamily') == "times") { ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{font-family:"Times New Roman", Times, serif;}
<?php } elseif($this->params->get('headingFontFamily') == "courier") { ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{font-family:"Courier New", Courier, monospace;}
<?php }elseif($this->params->get('headingFontFamily') == "georgia") { ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{font-family:Georgia,"Times New Roman", Times, serif;}
<?php } ?>
<?php if(($this->countModules('left') == 0) && ($this->countModules('right') == 0)) { ?>
#content{width:100%;}
<?php } ?>
<?php if(($this->countModules('left') >= 1) && ($this->countModules('right') == 0)) { ?>

<?php } ?>
<?php if(($this->countModules('left') == 0) && ($this->countModules('right') >= 1)) { ?>

<?php } ?>
<?php if($this->params->get('customWidth')) { ?>
#toolbar, #wrapper, #footer {width:<?php echo $this->params->get('customWidth');?>;}
<?php } ?>
<?php if($this->params->get('fontColor')){ ?>
body{color:<?php echo $this->params->get('fontColor'); ?>}
<?php } ?>
<?php if($this->params->get('headingColor')){ ?>
h1, h2, h3, h4, h5, h6, .componentheading, .contentheading{color:<?php echo $this->params->get('headingColor'); ?>}
<?php } ?>
<?php if($this->params->get('linkColor')){ ?>
a:link, a:active, a:visited{color:<?php echo $this->params->get('linkColor'); ?>}
<?php } ?>
<?php if($this->params->get('linkHoverColor')){ ?>
a:hover{color:<?php echo $this->params->get('linkHoverColor'); ?>}
<?php } ?>
</style>
</head>
<body>
<?php if (($this->countModules('nav-1')) || ($this->countModules('nav-2'))) { ?>
<div id="toolbar">
    <div class="inside clearfix">
    	<?php if ($this->countModules('nav-1')) { ?>
        <div id="toolbar-l">
        	<jdoc:include type="modules" name="nav-1" />
        </div>
        <?php } ?>
        <?php if ($this->countModules('nav-2')) { ?>
        <div id="toolbar-r">
        	<jdoc:include type="modules" name="nav-2" />
        </div>
        <?php } ?>
        <div class="clr"></div>
    </div>
</div>
<?php } ?>
<div id="wrapper">
	<div id="wrapper-inner">
        <div id="header">
            <a href="<?php echo $app->getCfg('live_site'); ?>" id="logo" title="<?php echo $app->getCfg('sitename'); ?>">
            <h1><?php echo $app->getCfg('sitename'); ?></h1>
            </a>
            <?php if ($this->countModules('nav-3')) { ?>
            <div id="topmenu">
                <jdoc:include type="modules" name="nav-3" />
                <div class="clr"></div>
            </div>
            <?php } ?>
            <div class="clr"></div>
        </div>
        <?php if ($this->countModules('banner')) { ?>
        <div id="banner">
            <jdoc:include type="modules" name="banner" />
            <div class="clr"></div>
        </div>
        <?php } else { ?>
        <!--Begin placeholder banner-->
        <div id="banner">
            <p><img width="305" height="223" style="float: left; margin-right: 15px; margin-top:-15px; margin-bottom: -15px;" src="templates/jp_genesis_j2.5/images/hero.png" alt="banner"></p>
            <div style="overflow: hidden;">
                <h2>Placeholder Banner</h2>
                <p>To remove this placeholder either edit the index.php of this template or publish a module in the banner position.</p>
            </div>
            <div class="clr"></div>
        </div>
        <!--End placeholder banner-->
        <?php } ?>
        <?php if (($this->countModules('inset-1')) || ($this->countModules('inset-2'))) { ?>
        <div id="inset">
        	<div class="inside clearfix">
	            <?php if ($this->countModules('inset-1')) { ?>
            	<div id="pathway">
    	        	<jdoc:include type="modules" name="inset-1" />
                </div>
                <?php } ?>
                <?php if ($this->countModules('inset-2')) { ?>
                <div id="search">
        	        <jdoc:include type="modules" name="inset-2" />
                </div>
                <?php } ?>
                <div class="clr"></div>
            </div>
        </div>
        <?php } ?>
        <div id="container">
        	<?php if ( $this->countModules('sidebar-2') OR $this->countModules('left') ) { ?>
            <div id="sidebar2">
            	<jdoc:include type="modules" name="sidebar-2" style="xhtml" />
                <jdoc:include type="modules" name="left" style="xhtml" />
            	<div class="clr"></div>
            </div>
            <?php } ?>
            <?php if ( $this->countModules('sidebar-1') OR $this->countModules('right') ) { ?>
            <div id="sidebar">
            	<jdoc:include type="modules" name="sidebar-1" style="xhtml" />
                <jdoc:include type="modules" name="right" style="xhtml" />
            	<div class="clr"></div>
            </div>
            <?php } ?>
            <div id="content">
            	<div id="content-inner">
                	<?php if (($this->countModules('elements-1')) || ($this->countModules('elements-2'))) { ?>
                	<div id="elements">
                    	<?php if ($this->countModules('elements-1')) { ?>
                    	<div id="elements-l">
                        	<jdoc:include type="modules" name="elements-1" style="xhtml" />
                        </div>
                        <?php } ?>
                        <?php if ($this->countModules('elements-2')) { ?>
                        <div id="elements-r">
                        	<jdoc:include type="modules" name="elements-2" style="xhtml" />
                        </div>
                        <?php } ?>
                    	<div class="clr"></div>
                    </div>
                    <?php } ?>
                	<jdoc:include type="message" />
                	<jdoc:include type="modules" name="before" style="xhtml" />
                    <jdoc:include type="component" />
                    <jdoc:include type="modules" name="after" style="xhtml" />
                	<div class="clr"></div>
                </div>
            </div>
        	<div class="clr"></div>
        </div>
        <?php if ($this->countModules('bottom')) { ?>
        <div id="bottom">
        	<div id="bottommenu">
            	<div class="inside clearfix">
                    <jdoc:include type="modules" name="bottom" />
                    <div class="clr"></div>
				</div>
            </div>
        	<div class="clr"></div>
        </div>
        <?php } ?>
    	<div class="clr"></div>
    </div>
</div>
<div id="footer">
    <div id="copy">
	    <jdoc:include type="modules" name="footer" />
    </div>
  <div id="link">
        <?php /* You are free to remove or edit the following */ print "<a href=\"http://www.joomlapraise.com/joomla/templates.php\" title=\"Joomla! Templates\" target=\"_blank\">Joomla! Templates</a> &amp; <a href=\"http://www.joomlapraise.com/joomla/extensions.php\" title=\"Joomla! Extensions\" target=\"_blank\">Joomla! Extensions</a> by <a href=\"http://www.joomlapraise.com\" title=\"Joomla! Templates and Extensions\" target=\"_blank\">JoomlaPraise</a>"; ?>
    </div>
    <div class="clr"></div>
</div>
<?php if ($this->countModules('debug')) { ?>
<div id="debug">
	<div class="inside clearfix">
    	<jdoc:include type="modules" name="debug" style="xhtml" />
    </div>
</div>
<?php } ?>
</body>
</html>
