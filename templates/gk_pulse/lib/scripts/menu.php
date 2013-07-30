<?php

/**
* GK MooMenu v.2.2
* @package Joomla!
* @Copyright (C) 2008 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 2.2 $
**/

// set animation type
switch($_GET['animation'])
{
	case 1:		$animation = 'Fx.Transitions.linear';break;
	case 2:		$animation = 'Fx.Transitions.Quad.easeIn';break;
	case 3:		$animation = 'Fx.Transitions.Quad.easeOut';break;
	case 4:		$animation = 'Fx.Transitions.Quad.easeInOut';break;
	case 5:		$animation = 'Fx.Transitions.Cubic.easeIn';break;
	case 6:		$animation = 'Fx.Transitions.Cubic.easeOut';break;
	case 7:		$animation = 'Fx.Transitions.Cubic.easeInOut';break;
	case 8:		$animation = 'Fx.Transitions.Quart.easeIn';break;
	case 9:		$animation = 'Fx.Transitions.Quart.easeOut';break;
	case 10:	$animation = 'Fx.Transitions.Quart.easeInOut';break;
	case 11:	$animation = 'Fx.Transitions.Quint.easeIn';break;
	case 12:	$animation = 'Fx.Transitions.Quint.easeOut';break;
	case 13:	$animation = 'Fx.Transitions.Quint.easeInOut';break;
	case 14:	$animation = 'Fx.Transitions.Pow.easeIn';break;
	case 15:	$animation = 'Fx.Transitions.Pow.easeOut';break;
	case 16:	$animation = 'Fx.Transitions.Pow.easeInOut';break;
	case 17:	$animation = 'Fx.Transitions.Expo.easeIn';break;
	case 18:	$animation = 'Fx.Transitions.Expo.easeOut';break;
	case 19:	$animation = 'Fx.Transitions.Expo.easeInOut';break;
	case 20:	$animation = 'Fx.Transitions.Circ.easeIn';break;
	case 21:	$animation = 'Fx.Transitions.Circ.easeOut';break;
	case 22:	$animation = 'Fx.Transitions.Circ.easeInOut';break;
	case 23:	$animation = 'Fx.Transitions.Sine.easeIn';break;
	case 24:	$animation = 'Fx.Transitions.Sine.easeOut';break;
	case 25:	$animation = 'Fx.Transitions.Sine.easeInOut';break;
	case 26:	$animation = 'Fx.Transitions.Back.easeIn';break;
	case 27:	$animation = 'Fx.Transitions.Back.easeOut';break;
	case 28:	$animation = 'Fx.Transitions.Back.easeInOut';break;
	case 29:	$animation = 'Fx.Transitions.Bounce.easeIn';break;
	case 30:	$animation = 'Fx.Transitions.Bounce.easeOut';break;
	case 31:	$animation = 'Fx.Transitions.Bounce.easeInOut';break;
	case 32:	$animation = 'Fx.Transitions.Elastic.easeIn';break;
	case 33:	$animation = 'Fx.Transitions.Elastic.easeOut';break;
	case 34:	$animation = 'Fx.Transitions.Elastic.easeInOut';break;
}

// set document type as text/javascript	
header("Content-Type: text/javascript");
// set menu ID
$menu_ID = 'horiz-menu';

?>
// GK MooMenu v.2.2 Copyright by GavickPro
window.addEvent("domready", function(){
	// necessary classes
	<?php if($_GET['height'] == 1) : ?>
	Fx.Height = Fx.Style.extend({initialize: function(el, options){$(el).setStyle('overflow', 'hidden');this.parent(el, 'height', options);},toggle: function(){var style = this.element.getStyle('height').toInt();return (style > 0) ? this.start(style, 0) : this.start(0, this.element.scrollHeight);},show: function(){return this.set(this.element.scrollHeight);}});
	<?php endif;?>
	<?php if($_GET['width'] == 1) : ?>
	Fx.Width = Fx.Style.extend({initialize: function(el, options){this.element = $(el);this.element.setStyle('overflow', 'hidden');this.iniWidth = this.element.getStyle('width').toInt();this.parent(this.element, 'width', options);},toggle: function(){var style = this.element.getStyle('width').toInt(); return (style > 0) ? this.start(style, 0) : this.start(0, this.iniWidth);},show: function(){return this.set(this.iniWidth);}});
	<?php endif;?>
	<?php if($_GET['opacity'] == 1) : ?>
	Fx.Opacity = Fx.Style.extend({initialize: function(el, options){this.now = 1;this.parent(el, 'opacity', options);},toggle: function(){return (this.now > 0) ? this.start(1, 0) : this.start(0, 1);},show: function(){return this.set(1);}});
	<?php endif;?>

	var main = $("<?php echo $menu_ID; ?>");
	var levels = new Array();
	<?php if($_GET['opacity'] == 1) : ?>var opacityFX = new Array();<?php endif; ?>
	<?php if($_GET['height'] == 1) : ?>var heightFX = new Array();<?php endif; ?>
	<?php if($_GET['width'] == 1) : ?>var widthFX = new Array();<?php endif; ?>
	if(main){
		main.getChildren().each(function(el,i){
			levels.push(new Array());
			<?php if($_GET['opacity'] == 1) : ?>opacityFX.push(new Array());<?php endif; ?>
			<?php if($_GET['height'] == 1) : ?>heightFX.push(new Array());<?php endif; ?>
			<?php if($_GET['width'] == 1) : ?>widthFX.push(new Array());<?php endif; ?>
			
			el.getElementsBySelector("ul").each(function(elm,j){
				levels[i].push(elm.getParent());
				<?php if($_GET['opacity'] == 1) : ?>opacityFX[i].push(new Fx.Opacity(elm, {duration: <?php echo $_GET['speed'] ?>, transition: <?php echo $animation; ?>,wait:true}).set(0));<?php endif; ?>
				<?php if($_GET['height'] == 1) : ?>heightFX[i].push(new Fx.Height(elm, {duration: <?php echo $_GET['speed'] ?>, transition: <?php echo $animation; ?>,wait:true}).set(0));<?php endif; ?>
				<?php if($_GET['width'] == 1) : ?>widthFX[i].push(new Fx.Width(elm, {duration: <?php echo $_GET['speed'] ?>, transition: <?php echo $animation; ?>,wait:true}).set(0));<?php endif; ?>
			});
		});
		
		levels.each(function(e,k){
			e.each(function(a,l){
				a.addEvents({
					"mouseenter" : function(){
						a.getChildren()[1].setStyle("overflow","hidden");
						if(window.ie7 && (a.getChildren()[1].getParent() && a.getChildren()[1].getParent().getParent() && a.getChildren()[1].getParent().getParent().getParent() && a.getChildren()[1].getParent().getParent().getParent().hasClass("level1")) && a.getChildren()[1].getStyle("position") != 'absolute') a.getChildren()[1].setStyle("margin-top","35px");
						a.getChildren()[1].setStyle("position","absolute");
						<?php if($_GET['opacity'] == 1) : ?>opacityFX[k][l].toggle();<?php endif; ?>
						<?php if($_GET['height'] == 1) : ?>heightFX[k][l].toggle();<?php endif; ?>
						<?php if($_GET['width'] == 1) : ?>widthFX[k][l].toggle();<?php endif; ?>
						(function(){a.getChildren()[1].setStyle("overflow","")}).delay(<?php echo $_GET['speed'] ?>);
					},
					"mouseleave" : function(){
						a.getChildren()[1].setStyle("overflow","hidden");
						<?php if($_GET['opacity'] == 1) : ?>opacityFX[k][l].stop().set(0);<?php endif; ?>
						<?php if($_GET['height'] == 1) : ?>heightFX[k][l].stop().set(0);<?php endif; ?>
						<?php if($_GET['width'] == 1) : ?>widthFX[k][l].stop().set(0);<?php endif; ?>
					}
				});
			});
		});	
	}
});