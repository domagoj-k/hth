/*--------------------------------------------------------------
# Pulse - October 2009 (for Joomla 1.5)
# Copyright (C) 2007-2009 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com  
---------------------------------------------------------------*/

window.addEvent("load",function(){
	var $b = $(document.getElementsByTagName('body')[0]);
	// smoothscroll init
	new SmoothScroll();
	// animation classes - Fx.Height and Fx.Opacity
	Fx.Height = Fx.Style.extend({initialize: function(el, options){this.parent(el, 'height', options);this.element.setStyle('overflow', 'hidden');},toggle: function(){return (this.element.offsetHeight > 0) ? this.custom(this.element.offsetHeight, 0) : this.custom(0, this.element.scrollHeight);},show: function(){return this.set(this.element.scrollHeight);}});
	Fx.Opacity = Fx.Style.extend({initialize: function(el, options){this.now = 1;this.parent(el, 'opacity', options);},toggle: function(){return (this.now > 0) ? this.start(1, 0) : this.start(0, 1);},show: function(){return this.set(1);}});
	//
	if($('stylearea')){
		$A($$('.style_switcher')).each(function(element,index){
			element.addEvent('click',function(event){
				var event = new Event(event);
				event.preventDefault();
				changeStyle(index+1);
			});
		});
		$A($$('.bg_switcher')).each(function(element,index){
			element.addEvent('click',function(event){
				var event = new Event(event);
				event.preventDefault();
				changeBg(index);
			});
		});
		new SmoothScroll();
	}
	//
	if($('login')) $('login').addEvent("click",function(e){new Event(e).stop();
		gk_popup('popup_login',600,80);
	});
	
	if($('login_noborder')) $('login_noborder').addEvent("click",function(e){new Event(e).stop();
		gk_popup('popup_login',600,80);
	});
	
	if($('register')) $('register').addEvent("click",function(e){new Event(e).stop();
		gk_popup('popup_register',500,300);
	});
	//
	// users_wrap I
	//
	if($ES('.users_wrap')[0]){
		if($ES('.moduletable_content', $ES('.users_wrap')[0]).length > 0){
			var max = 0;
			$ES('.moduletable_content', $ES('.users_wrap')[0]).each(function(el){ if(el.getSize().size.y > max) max = el.getSize().size.y; });	
			$ES('.moduletable_content', $ES('.users_wrap')[0]).each(function(el){ el.setStyle("height", max+"px"); });	
		}		
	}
	// users_wrap II
	if($ES('.users_wrap')[1]){
		if($ES('.moduletable_content', $ES('.users_wrap')[1]).length > 0){
			var max = 0;
			$ES('.moduletable_content', $ES('.users_wrap')[1]).each(function(el){ if(el.getSize().size.y > max) max = el.getSize().size.y; });	
			$ES('.moduletable_content', $ES('.users_wrap')[1]).each(function(el){ el.setStyle("height", max+"px"); });	
		}			
	}
	// users_wrap III
	if($('bottom1')){
		if($ES('.moduletable_content', $('bottom1')).length > 0){
			var max = 0;
			$ES('.moduletable_content', $('bottom1')).each(function(el){ if(el.getSize().size.y > max) max = el.getSize().size.y; });
			$ES('.moduletable_content', $('bottom1')).each(function(el){ el.setStyle("height", max+"px"); });	
		}			
	}

});

function gk_popup(popup_id, x, y){
	var p = $(popup_id);
 	var overlay = $('gk_overlay');
 	overlay.setStyle("display","block");
 	var overlay_o = new Fx.Opacity(overlay,{duration:300}).set(0);
 
	if(p.getStyle("display") != "block"){
		p.setStyle("display","block");
		p.setStyle("left",((window.getSize().size.x - 40 - x) / 2)+"px");
	  
		var fintop = ((window.getSize().size.y - 40 - y) / 2);
	  
		if(window.opera) p.setStyle("top","50px");
		if(window.opera) fintop = 50;
		
		new Fx.Style(p,'top',{duration:350}).start(0,fintop);
		
		new Fx.Opacity(p,{duration:350}).start(1);
		overlay_o.start(0.7);
		p.setStyles({
			"width":x+40+"px",
			"height":y+40+"px"
		}); 
		
		new Fx.Style($E('.gkp_t',p),'width',{duration:350}).start(0,x);
		new Fx.Style($E('.gkp_b',p),'width',{duration:350}).start(0,x);
		new Fx.Style($E('.gkp_m',p),'width',{duration:350}).start(0,x);
		
		new Fx.Style($E('.gkp_m',p),'height',{duration:350}).start(0,y);
		new Fx.Style($E('.gkp_ml',p),'height',{duration:350}).start(0,y);
		new Fx.Style($E('.gkp_mr',p),'height',{duration:350}).start(0,y);
		
		$E('.gk_popup_close',p).setStyle("opacity",0);
		(function(){new Fx.Opacity($E('.gk_popup_close',p),{duration:350}).start(1);}).delay(350);
		
		$E('.popup_padding',p).setStyle('opacity',0);
		(function(){new Fx.Opacity($E('.popup_padding',p),{duration:350}).start(0,1);}).delay(350);
		
		$E('.gk_popup_close',p).onclick = function(){
			new Fx.Opacity($E('.gk_popup_close',p),{duration:350}).start(0);
			new Fx.Opacity($E('.popup_padding',p),{duration:350}).start(0);
			overlay_o.start(0);
			(function(){
				new Fx.Opacity(p, {duration:350}).start(0);
				new Fx.Style(p, 'top',{duration:350}).start(fintop, 0);
				new Fx.Style($E('.gkp_t', p),'width',{duration:350}).start(x, 0);
				new Fx.Style($E('.gkp_b', p),'width',{duration:350}).start(x, 0);
				new Fx.Style($E('.gkp_m', p),'width',{duration:350}).start(x, 0);
				
				new Fx.Style($E('.gkp_m', p),'height',{duration:350}).start(y, 0);
				new Fx.Style($E('.gkp_ml', p),'height',{duration:350}).start(y, 0);
				new Fx.Style($E('.gkp_mr', p),'height',{duration:350}).start(y, 0);
				
				(function(){
				 	p.setStyle("display","none");
				}).delay(350);
			}).delay(350); 
		};
	}
}
// Function to change backgrounds
function changeStyle(style){
	var file = $template_path+'/css/style'+style+'.css';
	new Asset.css(file);
	new Cookie.set('gk30_style',style,{duration: 200,path: "/"});
}
function changeBg(style){
	var file = $template_path+'/css/'+((style == 1) ? 'dark' : 'white')+'.css';
	new Asset.css(file);
	new Cookie.set('gk30_bg',(style == 1) ? 'dark' : 'white',{duration: 200,path: "/"});
}