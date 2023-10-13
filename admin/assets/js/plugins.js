
(function(window){'use strict';function classReg(className){return new RegExp("(^|\\s+)"+className+"(\\s+|$)");}
var hasClass,addClass,removeClass;if('classList'in document.documentElement){hasClass=function(elem,c){return elem.classList.contains(c);};addClass=function(elem,c){elem.classList.add(c);};removeClass=function(elem,c){elem.classList.remove(c);};}
else{hasClass=function(elem,c){return classReg(c).test(elem.className);};addClass=function(elem,c){if(!hasClass(elem,c)){elem.className=elem.className+' '+c;}};removeClass=function(elem,c){elem.className=elem.className.replace(classReg(c),' ');};}
function toggleClass(elem,c){var fn=hasClass(elem,c)?removeClass:addClass;fn(elem,c);}
var classie={hasClass:hasClass,addClass:addClass,removeClass:removeClass,toggleClass:toggleClass,has:hasClass,add:addClass,remove:removeClass,toggle:toggleClass};if(typeof define==='function'&&define.amd){define(classie);}else{window.classie=classie;}})(window);(function(root){var factory=function($){var Toggles=root['Toggles']=function(el,opts){var self=this;if(typeof opts==='boolean'&&el.data('toggles')){el.data('toggles').toggle(opts);return;}
var dataAttr=['on','drag','click','width','height','animate','easing','type','checkbox'];var dataOpts={};for(var i=0;i<dataAttr.length;i++){var opt=el.data('toggle-'+dataAttr[i]);if(typeof opt!=='undefined')dataOpts[dataAttr[i]]=opt;}
opts=self.opts=$.extend({'drag':true,'click':true,'text':{'on':'ON','off':'OFF'},'on':false,'animate':250,'easing':'swing','checkbox':null,'clicker':null,'width':50,'height':20,'type':'compact','event':'toggle'},opts||{},dataOpts);self.el=el;el.data('toggles',self);self.selectType=opts['type']==='select';self.checkbox=$(opts['checkbox']);if(opts['clicker'])self.clicker=$(opts['clicker']);self.createEl();self.bindEvents();self['active']=!opts['on'];self.toggle(opts['on'],true,true);};Toggles.prototype.createEl=function(){var self=this;var height=self.el.height();var width=self.el.width();if(!height)self.el.height(height=self.opts['height']);if(!width)self.el.width(width=self.opts['width']);self.h=height;self.w=width;var div=function(name){return $('<div class="toggle-'+name+'">');};self.els={slide:div('slide'),inner:div('inner'),on:div('on'),off:div('off'),blob:div('blob')};var halfHeight=height/2;var onOffWidth=width-halfHeight;var isSelect=self.selectType;self.els.on.css({height:height,width:onOffWidth,textIndent:isSelect?'':-halfHeight,lineHeight:height+'px'}).html(self.opts['text']['on']);self.els.off.css({height:height,width:onOffWidth,marginLeft:isSelect?'':-halfHeight,textIndent:isSelect?'':halfHeight,lineHeight:height+'px'}).html(self.opts['text']['off']);self.els.blob.css({height:height,width:height,marginLeft:-halfHeight});self.els.inner.css({width:width*2-height,marginLeft:(isSelect||self['active'])?0:-width+height});if(self.selectType){self.els.slide.addClass('toggle-select');self.el.css('width',onOffWidth*2);self.els.blob.hide();}
self.els.inner.append(self.els.on,self.els.blob,self.els.off);self.els.slide.html(self.els.inner);self.el.html(self.els.slide);};Toggles.prototype.bindEvents=function(){var self=this;var clickHandler=function(e){if(e['target']!==self.els.blob[0]||!self.opts['drag']){self.toggle();}};if(self.opts['click']&&(!self.opts['clicker']||!self.opts['clicker'].has(self.el).length)){self.el.on('click',clickHandler);}
if(self.opts['clicker']){self.opts['clicker'].on('click',clickHandler);}
if(self.opts['drag']&&!self.selectType)self.bindDrag();};Toggles.prototype.bindDrag=function(){var self=this;var diff;var slideLimit=(self.w-self.h)/4;var upLeave=function(e){self.el.off('mousemove');self.els.slide.off('mouseleave');self.els.blob.off('mouseup');if(!diff&&self.opts['click']&&e.type!=='mouseleave'){self.toggle();return;}
var overBound=self['active']?diff<-slideLimit:diff>slideLimit;if(overBound){self.toggle();}else{self.els.inner.stop().animate({marginLeft:self['active']?0:-self.w+self.h},self.opts['animate']/2);}};var wh=-self.w+self.h;self.els.blob.on('mousedown',function(e){diff=0;self.els.blob.off('mouseup');self.els.slide.off('mouseleave');var cursor=e.pageX;self.el.on('mousemove',self.els.blob,function(e){diff=e.pageX-cursor;var marginLeft;if(self['active']){marginLeft=diff;if(diff>0)marginLeft=0;if(diff<wh)marginLeft=wh;}else{marginLeft=diff+wh;if(diff<0)marginLeft=wh;if(diff>-wh)marginLeft=0;}
self.els.inner.css('margin-left',marginLeft);});self.els.blob.on('mouseup',upLeave);self.els.slide.on('mouseleave',upLeave);});};Toggles.prototype.toggle=function(state,noAnimate,noEvent){var self=this;if(self['active']===state)return;var active=self['active']=!self['active'];self.el.data('toggle-active',active);self.els.off.toggleClass('active',!active);self.els.on.toggleClass('active',active);self.checkbox.prop('checked',active);if(!noEvent)self.el.trigger(self.opts['event'],active);if(self.selectType)return;var margin=active?0:-self.w+self.h;self.els.inner.stop().animate({'marginLeft':margin},noAnimate?0:self.opts['animate']);};$.fn['toggles']=function(opts){return this.each(function(){new Toggles($(this),opts);});};};if(typeof define==='function'&&define['amd']){define(['jquery'],factory);}else{factory(root['jQuery']||root['Zepto']||root['ender']||root['$']||$);}})(this);!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0","padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});