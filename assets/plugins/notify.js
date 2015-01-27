// Metro Notification V6
// 
// Changes:
// - New Metro Generator
// - Bug fixes
// - Totally renew SidePanel
// - Side panel, now is called like a plugin
// - Check the Metro Generator to understand the properties of the new sidepanel and new stuff 
//      - For using the old version visit this site: http://srobbin.com/jquery-pageslide/
//      - I was using that version. But now I create my own, I hope you enjoy the new one.

/* Modernizr 2.7.0 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-cssanimations-shiv-cssclasses-testprop-testallprops-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function x(a){j.cssText=a}function y(a,b){return x(prefixes.join(a+";")+(b||""))}function z(a,b){return typeof a===b}function A(a,b){return!!~(""+a).indexOf(b)}function B(a,b){for(var d in a){var e=a[d];if(!A(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function C(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:z(f,"function")?f.bind(d||b):f}return!1}function D(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+n.join(d+" ")+d).split(" ");return z(b,"string")||z(b,"undefined")?B(e,b):(e=(a+" "+o.join(d+" ")+d).split(" "),C(e,b,c))}var d="2.7.0",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m="Webkit Moz O ms",n=m.split(" "),o=m.toLowerCase().split(" "),p={},q={},r={},s=[],t=s.slice,u,v={}.hasOwnProperty,w;!z(v,"undefined")&&!z(v.call,"undefined")?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=t.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(t.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(t.call(arguments)))};return e}),p.cssanimations=function(){return D("animationName")};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)w(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},x(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._domPrefixes=o,e._cssomPrefixes=n,e.testProp=function(a){return B([a])},e.testAllProps=D,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+s.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

//Colors
(function(a,b){function m(a,b,c){var d=h[b.type]||{};return a==null?c||!b.def?null:b.def:(a=d.floor?~~a:parseFloat(a),isNaN(a)?b.def:d.mod?(a+d.mod)%d.mod:0>a?0:d.max<a?d.max:a)}function n(b){var c=f(),d=c._rgba=[];return b=b.toLowerCase(),l(e,function(a,e){var f,h=e.re.exec(b),i=h&&e.parse(h),j=e.space||"rgba";if(i)return f=c[j](i),c[g[j].cache]=f[g[j].cache],d=c._rgba=f._rgba,!1}),d.length?(d.join()==="0,0,0,0"&&a.extend(d,k.transparent),c):k[b]}function o(a,b,c){return c=(c+1)%1,c*6<1?a+(b-a)*c*6:c*2<1?b:c*3<2?a+(b-a)*(2/3-c)*6:a}var c="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",d=/^([\-+])=\s*(\d+\.?\d*)/,e=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(a){return[a[1],a[2],a[3],a[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(a){return[a[1]*2.55,a[2]*2.55,a[3]*2.55,a[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(a){return[parseInt(a[1],16),parseInt(a[2],16),parseInt(a[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(a){return[parseInt(a[1]+a[1],16),parseInt(a[2]+a[2],16),parseInt(a[3]+a[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(a){return[a[1],a[2]/100,a[3]/100,a[4]]}}],f=a.Color=function(b,c,d,e){return new a.Color.fn.parse(b,c,d,e)},g={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},h={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},i=f.support={},j=a("<p>")[0],k,l=a.each;j.style.cssText="background-color:rgba(1,1,1,.5)",i.rgba=j.style.backgroundColor.indexOf("rgba")>-1,l(g,function(a,b){b.cache="_"+a,b.props.alpha={idx:3,type:"percent",def:1}}),f.fn=a.extend(f.prototype,{parse:function(c,d,e,h){if(c===b)return this._rgba=[null,null,null,null],this;if(c.jquery||c.nodeType)c=a(c).css(d),d=b;var i=this,j=a.type(c),o=this._rgba=[],p;d!==b&&(c=[c,d,e,h],j="array");if(j==="string")return this.parse(n(c)||k._default);if(j==="array")return l(g.rgba.props,function(a,b){o[b.idx]=m(c[b.idx],b)}),this;if(j==="object")return c instanceof f?l(g,function(a,b){c[b.cache]&&(i[b.cache]=c[b.cache].slice())}):l(g,function(b,d){var e=d.cache;l(d.props,function(a,b){if(!i[e]&&d.to){if(a==="alpha"||c[a]==null)return;i[e]=d.to(i._rgba)}i[e][b.idx]=m(c[a],b,!0)}),i[e]&&a.inArray(null,i[e].slice(0,3))<0&&(i[e][3]=1,d.from&&(i._rgba=d.from(i[e])))}),this},is:function(a){var b=f(a),c=!0,d=this;return l(g,function(a,e){var f,g=b[e.cache];return g&&(f=d[e.cache]||e.to&&e.to(d._rgba)||[],l(e.props,function(a,b){if(g[b.idx]!=null)return c=g[b.idx]===f[b.idx],c})),c}),c},_space:function(){var a=[],b=this;return l(g,function(c,d){b[d.cache]&&a.push(c)}),a.pop()},transition:function(a,b){var c=f(a),d=c._space(),e=g[d],i=this.alpha()===0?f("transparent"):this,j=i[e.cache]||e.to(i._rgba),k=j.slice();return c=c[e.cache],l(e.props,function(a,d){var e=d.idx,f=j[e],g=c[e],i=h[d.type]||{};if(g===null)return;f===null?k[e]=g:(i.mod&&(g-f>i.mod/2?f+=i.mod:f-g>i.mod/2&&(f-=i.mod)),k[e]=m((g-f)*b+f,d))}),this[d](k)},blend:function(b){if(this._rgba[3]===1)return this;var c=this._rgba.slice(),d=c.pop(),e=f(b)._rgba;return f(a.map(c,function(a,b){return(1-d)*e[b]+d*a}))},toRgbaString:function(){var b="rgba(",c=a.map(this._rgba,function(a,b){return a==null?b>2?1:0:a});return c[3]===1&&(c.pop(),b="rgb("),b+c.join()+")"},toHslaString:function(){var b="hsla(",c=a.map(this.hsla(),function(a,b){return a==null&&(a=b>2?1:0),b&&b<3&&(a=Math.round(a*100)+"%"),a});return c[3]===1&&(c.pop(),b="hsl("),b+c.join()+")"},toHexString:function(b){var c=this._rgba.slice(),d=c.pop();return b&&c.push(~~(d*255)),"#"+a.map(c,function(a,b){return a=(a||0).toString(16),a.length===1?"0"+a:a}).join("")},toString:function(){return this._rgba[3]===0?"transparent":this.toRgbaString()}}),f.fn.parse.prototype=f.fn,g.hsla.to=function(a){if(a[0]==null||a[1]==null||a[2]==null)return[null,null,null,a[3]];var b=a[0]/255,c=a[1]/255,d=a[2]/255,e=a[3],f=Math.max(b,c,d),g=Math.min(b,c,d),h=f-g,i=f+g,j=i*.5,k,l;return g===f?k=0:b===f?k=60*(c-d)/h+360:c===f?k=60*(d-b)/h+120:k=60*(b-c)/h+240,j===0||j===1?l=j:j<=.5?l=h/i:l=h/(2-i),[Math.round(k)%360,l,j,e==null?1:e]},g.hsla.from=function(a){if(a[0]==null||a[1]==null||a[2]==null)return[null,null,null,a[3]];var b=a[0]/360,c=a[1],d=a[2],e=a[3],f=d<=.5?d*(1+c):d+c-d*c,g=2*d-f,h,i,j;return[Math.round(o(g,f,b+1/3)*255),Math.round(o(g,f,b)*255),Math.round(o(g,f,b-1/3)*255),e]},l(g,function(c,e){var g=e.props,h=e.cache,i=e.to,j=e.from;f.fn[c]=function(c){i&&!this[h]&&(this[h]=i(this._rgba));if(c===b)return this[h].slice();var d,e=a.type(c),k=e==="array"||e==="object"?c:arguments,n=this[h].slice();return l(g,function(a,b){var c=k[e==="object"?a:b.idx];c==null&&(c=n[b.idx]),n[b.idx]=m(c,b)}),j?(d=f(j(n)),d[h]=n,d):f(n)},l(g,function(b,e){if(f.fn[b])return;f.fn[b]=function(f){var g=a.type(f),h=b==="alpha"?this._hsla?"hsla":"rgba":c,i=this[h](),j=i[e.idx],k;return g==="undefined"?j:(g==="function"&&(f=f.call(this,j),g=a.type(f)),f==null&&e.empty?this:(g==="string"&&(k=d.exec(f),k&&(f=j+parseFloat(k[2])*(k[1]==="+"?1:-1))),i[e.idx]=f,this[h](i)))}})}),f.hook=function(b){var c=b.split(" ");l(c,function(b,c){a.cssHooks[c]={set:function(b,d){var e,g,h="";if(a.type(d)!=="string"||(e=n(d))){d=f(e||d);if(!i.rgba&&d._rgba[3]!==1){g=c==="backgroundColor"?b.parentNode:b;while((h===""||h==="transparent")&&g&&g.style)try{h=a.css(g,"backgroundColor"),g=g.parentNode}catch(j){}d=d.blend(h&&h!=="transparent"?h:"_default")}d=d.toRgbaString()}try{b.style[c]=d}catch(d){}}},a.fx.step[c]=function(b){b.colorInit||(b.start=f(b.elem,c),b.end=f(b.end),b.colorInit=!0),a.cssHooks[c].set(b.elem,b.start.transition(b.end,b.pos))}})},f.hook(c),a.cssHooks.borderColor={expand:function(a){var b={};return l(["Top","Right","Bottom","Left"],function(c,d){b["border"+d+"Color"]=a}),b}},k=a.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}})(jQuery);

var mnBlockedClick = true;
$(document).ready(function() {      
        // Plugins placing
        $("body").append("<div id='divSmallBoxes'></div>");
        $("body").append("<div id='divMiniIcons'></div><div id='divbigBoxes'></div>");

        $("body").on("click",".mnSideClose",function(){
            var SideID = $(this).attr("closeid");

            var OutAnimation = $("#"+SideID).attr("fadeout");
            var InAnimation = $("#"+SideID).attr("fadein");


            var ThisSide = $("#" + SideID);

            if(Modernizr.cssanimations == true){ 
                ThisSide.clearQueue().removeClass(InAnimation);
                ThisSide.addClass(OutAnimation).delay(300).queue(function(){
                    $(this).remove();
                });
            }
            else
            {
                var width = ThisSide.width() + 15;
                ThisSide.animate({
                    "right":"-"+ width +"px",
                },function(){
                    ThisSide.remove();
                })
            }
        });

        $("body").on("mouseover",".mnSidePanel",function(){
            mnBlockedClick = true;
        });

        $("body").on("mouseenter",".mnSidePanel",function(){
            mnBlockedClick = true;
        });

        $("body").on("mousemove",".mnSidePanel",function(){
            mnBlockedClick = true;
        });

        $("body").on("mouseleave",".mnSidePanel",function(){

            mnBlockedClick = false;
        });

        $("body").on("click",function(){

            if(mnBlockedClick == false){
                $(".mnSidePanel").each(function(){

                    var OutAnimation = $(this).attr("fadeout");
                    var InAnimation = $(this).attr("fadein");

                    var ThisSide = $(this);

                    if(Modernizr.cssanimations == true){ 
                        ThisSide.clearQueue().removeClass(InAnimation);
                        ThisSide.addClass(OutAnimation).delay(300).queue(function(){
                            $(this).remove();
                        });
                    }
                    else
                    {
                        var width = ThisSide.width() + 15;
                        ThisSide.animate({
                            "right":"-"+ width +"px",
                        },function(){
                            ThisSide.remove();
                        })
                    }

                });
            }
        });

        var TimeResize;
        $(window).resize(function(){
            // clearInterval(TimeResize);
            // TimeResize = setTimeout(function() {

                $(".mnSidePanel").each(function(){
                    var OriginalWidth = $(this).attr("width");
                    var Width = $(this).attr("width");

                    if(Width.indexOf("%")==-1){
                        Width = Width.replace("px","");
                        Width = Width*1;

                        var WindowWidth = $(window).width();
                        if(WindowWidth <= Width)
                            $(this).css("width","92%");
                        else
                            $(this).css("width",OriginalWidth);
                        
                    }
                    else
                        return;
                        

                });


            // }, 200);
        })

    });


//Closing Rutine for Loadings
function MetroUnLoading() 
{

    $(".divMessageBox").fadeOut(300,function(){
        $(this).remove();
    });

    $(".LoadingBoxContainer").fadeOut(300,function(){
        $(this).remove();
    });    
}




// Metro SidePanel
(function ($) 
{
    var SideCount = 0;
    var SideColorTimer;

    $.MetroSidePanel = function (settings,callback) 
    {
        SideCount += 1;
        var Content = "";
        var ThisID = "mnSide" + SideCount;
        mnBlockedClick = true;

        settings = $.extend({
            title: undefined,
            content: undefined,
            iframe: undefined,
            position: "right",
            animation: "fadeInRight",
            width: "300px",
            shadow: true,
            backgroundcontent: "#662d91",
            colortime: 1500,
            colors: undefined,
        }, settings);


        if(settings.position == "right")
            Content += '<div id="'+ ThisID +'" class="mnSidePanel mnSidePanelRight fast">';
        else
            Content += '<div id="'+ ThisID +'" class="mnSidePanel mnSidePanelLeft fast">';

        Content +=     '<span class="mnSideClose" closeid="'+ ThisID +'">X</span>';

        if(settings.title !=undefined)
            Content += '<div class="mnSideTitle animated fadeIn">'+ settings.title +'</div>';

        if(settings.content != undefined)
            Content += '<div class="mnSideContent animated fadeIn">'+ settings.content +'</div>';
        
        if(settings.iframe !=undefined)
            Content +=     '<iframe src="http://en.m.wikipedia.org/wiki/Main_Page" class="animated fadeIn" frameborder="0"></iframe>';

        Content += '</div>';

        $("body").append(Content);

        var ThisSide = $("#"+ThisID);

        if(settings.shadow)
            ThisSide.addClass("mnSideShadow");

        ThisSide.attr("width",settings.width);

        ThisSide.css({
            width: settings.width,
            "background-color": settings.backgroundcontent
        });

        var OriginalWidth = settings.width;
        var Width = OriginalWidth;

        if(Width.indexOf("%")==-1){
            Width = Width.replace("px","");
            Width = Width*1;

            var WindowWidth = $(window).width();
            if(WindowWidth <= Width)
                ThisSide.css("width","92%");
            else
                ThisSide.css("width",OriginalWidth);
            
        }

        if(Modernizr.cssanimations == true){
            //Is a modern Browser
            ThisSide.show().addClass("animated " + settings.animation);

            var FadeOutAnimation = settings.animation.replace("In","Out");
            
            ThisSide.attr("fadein",settings.animation);
            ThisSide.attr("fadeout",FadeOutAnimation);

        }
        else
        {
            // Old browser. Do not support css animatinos
            var width = ThisSide.width();
            ThisSide.css("right", "-" + width +"px");
            ThisSide.show();

                ThisSide.animate({
                    "right": "0px",
                },300);
        }

        if(settings.colors !=undefined){

            clearInterval(SideColorTimer);
            ThisSide.attr("colorcount","0");

            ColorTimeInterval = setInterval(function(){

                var ColorIndex = ThisSide.attr("colorcount");
 
                ThisSide.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                
                settings.NormalButton = settings.colors[ColorIndex].color;


                if(ColorIndex < settings.colors.length-1)
                    ThisSide.attr("colorcount",((ColorIndex*1)+1));
                else
                    ThisSide.attr("colorcount",0);
                    
            },settings.colortime)

        }

        setTimeout(function() {
            mnBlockedClick = false;   
        }, 300);
    }

})(jQuery);

// Messagebox
var ExistMsg = 0;
var MetroMSGboxCount = 0;
var PrevTop =  0;
var ColorTimeInterval;
var MsgCounter = 0;

(function ($) 
{
    $.MetroMessageBox = function (settings,callback) 
    {
        var MetroMSG, Content;
        settings = $.extend({
            title: "",
            content: "",
            NormalButton: undefined,
            ActiveButton: undefined,
            buttons: undefined,
            sound: false,
            input: undefined,
            placeholder: "",
            options: undefined,
            backgroundcolor: "#000000",
            backgroundcontent: "#232323",
            opacity: 0.7,
            colortime: 1500,
            colors: undefined,
            changeback: true,
            changecontent: true,
        }, settings);

        // <div class="divMessageBox animated fadeIn fast">
        //     <div class="MessageBoxContainer">
        //         <div class="MessageBoxMiddle">
        //             <h2>Hola Mundo</h2>
        //             <p class="pText">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        //             tempor incididunt ut labore et dolore magna aliqua. </p>
        //             <input type='text' id='' placeholder='Hola Mundo'/><br/><br/>
        //             <div class="MessageBoxButtonSection">
        //                 <button>Aceptar</button>
        //                 <button>Cancelar</button>
        //             </div>
        //         </div>
        //     </div>
        // </div>
        var PlaySound = 0;

        PlaySound =1;
        //Messagebox Sound

        // Messagebox Sound
        if(settings.sound===true)
        {
            if(isIE8orlower() == 0)
            {
                var audioElement = document.createElement('audio');
                if (navigator.userAgent.match('Firefox/'))
                    audioElement.setAttribute('src', 'static/sound/messagebox.ogg');
                else
                    audioElement.setAttribute('src', 'static/sound/messagebox.mp3');
                

                $.get();
                audioElement.addEventListener("load", function() {
                    audioElement.play();
                }, true);

                audioElement.pause();
                audioElement.play();
            }
        }

        

        MetroMSGboxCount = MetroMSGboxCount + 1;
        MsgCounter +=1;

        // if(ExistMsg==0)
        // {
        //     ExistMsg = 1;
        //     MetroMSG = "<div class='divMessageBox animated fadeIn fast' id='MsgBoxBack'></div>";
        //     $("body").append(MetroMSG);

        //     if(isIE8orlower() == 1)
        //     {
        //         $("#MsgBoxBack").addClass("MessageIE");
        //     }
        // }
        MetroMSG = "<div class='divMessageBox' id='MsgBoxBack" + MsgCounter + "'></div>";
        $("body").append(MetroMSG);

        var ThisBackground = $("#MsgBoxBack" + MsgCounter);

        ThisBackground.css({
                backgroundColor: settings.backgroundcolor,
                opacity: 0
            });

        ThisBackground.animate({
            opacity: settings.opacity,
        },300);


        var InputType="";
        var HasInput = 0;
        if(settings.input != undefined)
        {
            HasInput = 1;
            settings.input = settings.input.toLowerCase();

            switch(settings.input)
            {
            case "text":
              InputType = "<input type='"+ settings.input +"' id='txt"+ MetroMSGboxCount +"' placeholder='"+ settings.placeholder +"'/><br/><br/>";
              break;
            case "password":
              InputType = "<input type='"+ settings.input +"' id='txt"+ MetroMSGboxCount +"' placeholder='"+ settings.placeholder +"'/><br/><br/>";
              break;

            case "select":
                if(settings.options == undefined)
                {
                    alert("For this type of input, the options parameter is required.");
                }
                else
                {
                    InputType  = "<select id='txt"+ MetroMSGboxCount+"'>";
                    for (var i = 0; i <= settings.options.length-1; i++) 
                    {
                        if(settings.options[i]=="[")
                        {
                            Name = "";
                        }
                        else
                        {
                            if(settings.options[i]=="]")
                            {
                                NumBottons = NumBottons + 1;
                                Name = "<option>"+ Name +"</option>";
                                InputType += Name;
                            }
                            else
                            {
                                Name += settings.options[i];
                            }
                        }
                    };
                    InputType += "</select>"
                }

             break;
            default:
              alert("That type of input is not handled yet");
            }

            
        }


        Content  = "<div class='MessageBoxContainer' id='Msg"+ MsgCounter +"'>";
        Content += "<div class='MessageBoxMiddle' id='MsgMiddle"+ MsgCounter +"'>";
        Content += "<span class='MsgTitle'>"+ settings.title +"</span class='MsgTitle'>";
        Content += "<p class='pText'>" + settings.content + "</p>";
        Content += InputType;
        Content += "<div class='MessageBoxButtonSection'>";

        if(settings.buttons == undefined)
        {
            settings.buttons = "[Accept]";
        }

        settings.buttons =  $.trim(settings.buttons);
        settings.buttons = settings.buttons.split('');
        
        var Name = "";
        var NumBottons = 0;
        if(settings.NormalButton == undefined)
        {
            settings.NormalButton = "#232323";   
        }

        if(settings.ActiveButton == undefined)
        {
            settings.ActiveButton = "#ed145b";   
        }


        for (var i = 0; i <= settings.buttons.length-1; i++) 
        {

            if(settings.buttons[i]=="[")
            {
                Name = "";
            }
            else
            {
                if(settings.buttons[i]=="]")
                {
                    NumBottons = NumBottons + 1;
                    Name = "<button id='bot"+ NumBottons +"-Msg"+ MetroMSGboxCount +"' class='botTempo' style='background-color: "+ settings.NormalButton +";'> " + Name + "</button>";
                    Content += Name;
                }
                else
                {
                    Name += settings.buttons[i];
                }
            }
        };

        Content += "</div>"; //MessageBoxButtonSection
        Content += "</div>"; //MessageBoxMiddle
        Content += "</div>"; //MessageBoxContainer

        // alert(MetroMSGboxCount);
        // if(MetroMSGboxCount > 1)
        // {
        //     $(".MessageBoxContainer").hide();
        //     $(".MessageBoxContainer").css("z-index", 99999);
        // }

        // $(".divMessageBox").append(Content);
        $("body").append(Content);

        var Windowheight = $(window).height();
        var WindowWidth = $(window).width();

        var MsgContentBox = $("#MsgMiddle" + MsgCounter);
        var MsgContentBoxHeight = MsgContentBox.height();


        var MiddlePoint = (Windowheight / 2) - (MsgContentBoxHeight/2);

        var MsgContentBoxContainer = $("#Msg"+MsgCounter);
        MsgContentBoxContainer.css({
            "z-index":100001,
            top: MiddlePoint+ "px",
            opacity: 0,
            backgroundColor: settings.backgroundcontent,
        });

        MsgContentBoxContainer.animate({
            opacity: 1
        },300);
    
         // Color Functionality
        clearInterval(ColorTimeInterval);
        var BothChange = false;
        if(settings.colors !=undefined && settings.colors.length>0){ 
        
        if(settings.changeback == true && settings.changecontent == true){
            MsgContentBoxContainer.css("background-color",settings.backgroundcolor);
            ThisBackground.css("background-color",settings.backgroundcolor);

            BothChange = true;
        }

            MsgContentBoxContainer.attr("colorcount","0");

            ColorTimeInterval = setInterval(function(){

                var ColorIndex = MsgContentBoxContainer.attr("colorcount");

                if(settings.changecontent == true){
                    MsgContentBoxContainer.animate({
                        backgroundColor: settings.colors[ColorIndex].color,
                    });

                }
                
                var Buttons = MsgContentBoxContainer.find(".botTempo");
                Buttons.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                ThisBackground.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });


                settings.NormalButton = settings.colors[ColorIndex].color;


                if(ColorIndex < settings.colors.length-1){
                    MsgContentBoxContainer.attr("colorcount",((ColorIndex*1)+1));
                }else{
                    MsgContentBoxContainer.attr("colorcount",0);
                }

            },settings.colortime);
        }




        // Focus
        if(HasInput==1)
        {
            $("#txt"+MetroMSGboxCount).focus();
        }


        $('.botTempo').hover(function()
        {
            var ThisID = $(this).attr('id');
            // alert(ThisID);
            $("#"+ThisID).css("background-color", settings.ActiveButton);
        },function(){
            var ThisID = $(this).attr('id');
            $("#"+ThisID).css("background-color", settings.NormalButton);
        });

        // Callback and button Pressed
        $(".botTempo").click(function()
        {
            // Closing Method
            var ThisID = $(this).attr('id');
            var MsgBoxID  = ThisID.substr(ThisID.indexOf("-")+1);
            var Press = $.trim($(this).text());

            if(HasInput==1)
            {
                if (typeof callback == "function") 
                {   
                    var IDNumber = MsgBoxID.replace("Msg","");
                    var Value = $("#txt"+IDNumber).val();
                    if(callback) callback(Press, Value);
                }
            }
            else
            {
                if (typeof callback == "function") 
                {   
                    if(callback) callback(Press);
                }
            }

            ThisBackground.animate({
                opacity: 0,
            },300,function(){
                $(this).remove();
            });

            MsgContentBoxContainer.animate({
                opacity: 0,
            },300,function(){
                $(this).remove();
            });

            // $("#"+MsgBoxID).addClass("animated fadeOut fast");
            // MetroMSGboxCount = MetroMSGboxCount -1;

            // if(MetroMSGboxCount==0)
            // {
            //     $("#MsgBoxBack").removeClass("fadeIn").addClass("fadeOut").delay(300).queue(function()
            //     {
            //         ExistMsg = 0;
            //         $(this).remove();
            //     });
            // }
        });
            
    }

})(jQuery);

// Loading Screen
var Point = 1;
var MetroLoadingTimer = 0;
var PointText = "";
var MetroExist = false;
var ColorTimeInterval;
var LoadingCount = 0;

(function ($) 
{
    $.MetroLoading = function (settings,callback) 
    {
        var Content;

        settings = $.extend({
            title: undefined,
            content: undefined,
            img: undefined,
            timeout: undefined,
            special: undefined,
            backgroundcolor: "#000000",
            backgroundcontent: "#232323",
            opacity: 0.7,
            colortime: 1500,
            colors: undefined,
            changeback: true,
            changecontent: true,
        }, settings);

        MetroMSGboxCount = MetroMSGboxCount + 1;

        // if(ExistMsg==0)
        // {
        //     ExistMsg = 1;
        //     MetroMSG = "<div class='divMessageBox animated fadeIn fast' id='MsgBoxBack'></div>";
        //     $("body").append(MetroMSG);

        //     if(isIE8orlower() == 1)
        //     {
        //         $("#MsgBoxBack").addClass("MessageIE");
        //     }
        // }
        LoadingCount +=1;

        Content = "<div class='divMessageBox' id='LoadingBox"+ LoadingCount +"'></div>";
        $("body").append(Content);

        var ThisBackLoading = $("#LoadingBox" + LoadingCount);
        ThisBackLoading.css({
            "background-color": settings.backgroundcolor,
            opacity: settings.opacity,
            display: "none"
        });

        ThisBackLoading.fadeIn(300);


        if(settings.title == undefined)
        {
            settings.title = "Loading";
        }

        if(settings.content == undefined)
        {
            settings.content = "Please wait.";
        }

        var NoImage="";
        if(settings.img == undefined)
        {
            settings.img = "";
            NoImage = "<br/><br/><br/><br/><br/>"; 
        }
        else
        {
            settings.img = "<img src='"+ settings.img +"' class='animated fadeIn'/>";
        }


        var BodyLoading ="";
        BodyLoading += "<div class='LoadingBoxContainer' id='LoadingContainer" + LoadingCount + "'>";
        BodyLoading += "<div class='LoadingBoxMiddle'>";
        BodyLoading += "<div align='center'>";
        BodyLoading += "<br/><br/>"; 
        BodyLoading += settings.img;
        BodyLoading += "<br/><br/><br/>"; 

        if(settings.special == true)
        {
            // Special Loading type
            BodyLoading += "<span class='MsgTitle animated fadeIn' id='lblSpecialTitle'>"+ settings.title +"</span>";
        }
        else
        {
            // Normal loading
            BodyLoading += "<br/><span class='MsgTitle animated fadeIn'>"+ settings.title +"<span id='LoadingPoints'>.</span></span>";
            BodyLoading += "<p class='pText animated fadeIn'>"+ settings.content +"</p>";

        }

        BodyLoading += NoImage;
        BodyLoading += "</div>";
        BodyLoading += "</div>";
        BodyLoading += "</div>";

        
        // $(".divMessageBox").append(BodyLoading);
        $("body").append(BodyLoading);

        var Windowheight = $(window).height();
        var WindowWidth = $(window).width();

        var LoadingContentbox = $("#LoadingContainer" + LoadingCount);
        var LoadingContentboxHeight = LoadingContentbox.height();


        var MiddlePoint = (Windowheight / 2) - (LoadingContentboxHeight / 2);

        LoadingContentbox.css({
            "z-index":100001,
            backgroundColor: settings.backgroundcontent,
            top: MiddlePoint+ "px",
            opacity: 0,
            // backgroundColor: settings.backgroundcontent,
        });

        LoadingContentbox.animate({
            opacity: 1
        },300);


    
         // Color Functionality
        clearInterval(ColorTimeInterval);
        var BothChange = false;
        if(settings.colors !=undefined && settings.colors.length>0){ 


            LoadingContentbox.attr("colorcount","0");

            ColorTimeInterval = setInterval(function(){

                var ColorIndex = LoadingContentbox.attr("colorcount");

                if(settings.changecontent == true){
                    LoadingContentbox.animate({
                        backgroundColor: settings.colors[ColorIndex].color,
                    });
                }

                if(settings.changeback == true){
                    ThisBackLoading.animate({
                        backgroundColor: settings.colors[ColorIndex].color,
                    });
                }



                if(ColorIndex < settings.colors.length-1){
                    LoadingContentbox.attr("colorcount",((ColorIndex*1)+1));
                }else{
                    LoadingContentbox.attr("colorcount",0);
                }

            },settings.colortime);
        }




        var PointAnimation;
        clearInterval(PointAnimation);
        PointAnimation = setInterval(function()
        {

            if ($(".LoadingBoxContainer").length > 0)
            {
                // If loading exists
            }
            else
            {
                // If loading do not exist.
                window.clearInterval(PointAnimation);
            }

            if(settings.special == true)
            {
                // Special Loading
                if(MetroLoadingTimer==2)
                {
                    $("#lblSpecialTitle").removeClass("fadeIn").addClass("fadeOut").delay(300).queue(function()
                    {
                        $(this).text(settings.content);
                        $(this).clearQueue();
                        $(this).removeClass("fadeOut");
                        $(this).addClass("fadeIn");

                    });

                    MetroLoadingTimer += 1;
                }
                else
                {
                    if(MetroLoadingTimer == 5)
                    {
                        $("#lblSpecialTitle").removeClass("fadeIn").addClass("fadeOut").delay(300).queue(function()
                        {
                            $(this).text(settings.title);
                            $(this).clearQueue();
                            $(this).removeClass("fadeOut");
                            $(this).addClass("fadeIn");

                        });
                        MetroLoadingTimer = 0;
                    }
                    else
                    {
                        MetroLoadingTimer += 1;    
                    }
                }
               

            }
            else
            {
                // Normal Loading
                if(Point==0)
                {
                    PointText = ".";
                    Point +=1;
                }else if(Point == 1)
                {
                    PointText = "..";
                    Point +=1;
                }else if(Point == 2)
                {
                    PointText = "...";
                    Point += 1;
                }else if(Point == 3)
                {
                    PointText = "....";
                    Point = 0;
                }
                $("#LoadingPoints").text(PointText);
            }


        },750);

        
        if(settings.timeout != undefined){
            setTimeout(function() 
            {
                //Closing Rutine
                LoadingContentbox.fadeOut(300,function(){
                    $(this).remove();
                });

                ThisBackLoading.fadeOut(300,function(){
                    $(this).remove();
                });
                
                clearInterval(PointAnimation);

                if (typeof callback == "function") 
                {   
                    if(callback) callback();
                }
            }, settings.timeout);
        }

    
    }
})(jQuery);


// BigBox
var BigBoxes = 0;
var ColorTimeInterval;

(function ($) 
{
    $.bigBox = function (settings,callback) 
    {
        var boxBig, content;
        settings = $.extend({
            title: "",
            content: "",
            img: undefined,
            number: undefined,
            color: undefined,
            sound: true,
            timeout: undefined,
            colortime: 1500,
            colors:undefined
        }, settings);

        // bigbox Sound
        if(settings.sound === true)
        {
            if(isIE8orlower() == 0)
            {
                var audioElement = document.createElement('audio');

                if (navigator.userAgent.match('Firefox/'))
                    audioElement.setAttribute('src', 'static/sound/bigbox.ogg');
                else
                    audioElement.setAttribute('src', 'static/sound/bigbox.mp3');
                
                $.get();
                audioElement.addEventListener("load", function() {
                audioElement.play();
                }, true);

                audioElement.pause();
                audioElement.play();
            }    
        }
        
         


        
        // <div class="bigBox animated fadeInUp">
        // <span>Hola Mundo</span>
        // <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        // tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        // quis nostrud exercitation ullamco. </p>
        // <div class="bigboxicon">
        //     <img src="static/img/cloud.png">
        // </div>
        // <div class="bigboxnumber">
        //     3
        // </div>
        // </div>
        BigBoxes = BigBoxes + 1;
        
        boxBig =  "<div id='bigBox"+BigBoxes+"' class='bigBox animated fadeIn fast'><div id='bigBoxColor"+ BigBoxes+"'><img class='botClose' id='botClose"+ BigBoxes +"' src='static/img/close.png'>";
        boxBig +=  "<span>"+ settings.title +"</span>";
        boxBig +=  "<p>"+settings.content +"</p>";
        boxBig +=  "<div class='bigboxicon'>";

        if(settings.img == undefined)
        {
            settings.img = "static/img/cloud.png";
        }
        boxBig +=  "<img src='"+ settings.img +"'>";
        boxBig +=  "</div>";

        boxBig +=  "<div class='bigboxnumber'>";
        if(settings.number != undefined)
        {
            boxBig +=  settings.number;
        }
        boxBig +=  "</div></div>";
        boxBig +=  "</div>";


        // stacking method
        $("#divbigBoxes").append(boxBig);
       

        if(settings.color == undefined)
        {
            settings.color = "#004d60";
        }
        $("#bigBox"+BigBoxes).css("background-color", settings.color );


        $("#divMiniIcons").append("<div id='miniIcon"+BigBoxes+"' class='cajita animated fadeIn' style='background-color: "+settings.color+";'><img src='"+ settings.img +"'/></div>");


        //Click Mini Icon
         $("#miniIcon"+BigBoxes).bind('click', function() 
         {
            var FrontBox = $(this).attr('id');
            var FrontBigBox = FrontBox.replace("miniIcon","bigBox");
            var FronBigBoxColor = FrontBox.replace("miniIcon","bigBoxColor");

            $(".cajita").each(function( index ) 
            {   
                var BackBox = $(this).attr('id');
                var BigBoxID = BackBox.replace("miniIcon","bigBox");
                
                $("#"+BigBoxID).css("z-index", 9998);
            });

            $("#"+FrontBigBox).css("z-index", 9999);
            $("#"+FronBigBoxColor).removeClass("animated fadeIn").delay(1).queue(function()
            {
                $(this).show();
                $(this).addClass("animated fadeIn");
                $(this).clearQueue();

            });
                
            
         });

         var ThisBigBoxCloseCross = $("#botClose"+BigBoxes);
         var ThisBigBox = $("#bigBox"+BigBoxes);
         var ThisMiniIcon = $("#miniIcon"+BigBoxes);

        // Color Functionality
        clearInterval(ColorTimeInterval);
        if(settings.colors !=undefined && settings.colors.length>0){
            ThisBigBoxCloseCross.attr("colorcount","0");

            ColorTimeInterval = setInterval(function(){

                var ColorIndex = ThisBigBoxCloseCross.attr("colorcount");

                ThisBigBoxCloseCross.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                ThisBigBox.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                ThisMiniIcon.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                if(ColorIndex < settings.colors.length-1){
                    ThisBigBoxCloseCross.attr("colorcount",((ColorIndex*1)+1));
                }else{
                    ThisBigBoxCloseCross.attr("colorcount",0);
                }

            },settings.colortime);
        }


         //Close Cross
         ThisBigBoxCloseCross.bind('click', function() 
         {
            clearInterval(ColorTimeInterval);
            if (typeof callback == "function") 
            {   
                if(callback) callback();
            }

            var FrontBox = $(this).attr('id');
            var FrontBigBox = FrontBox.replace("botClose","bigBox");
            var miniIcon = FrontBox.replace("botClose","miniIcon");

            $("#"+FrontBigBox).removeClass("fadeIn fast");
            $("#"+FrontBigBox).addClass("fadeOut fast").delay(300).queue(function()
            {
                $(this).clearQueue();
                $(this).remove();
            });

            $("#"+miniIcon).removeClass("fadeIn fast");
            $("#"+miniIcon).addClass("fadeOut fast").delay(300).queue(function()
            {
                $(this).clearQueue();
                $(this).remove();
            });

            
         });

         if(settings.timeout != undefined)
        {
            var TimedID = BigBoxes;
            setTimeout(function() 
            {
                clearInterval(ColorTimeInterval);              
                $("#bigBox"+TimedID).removeClass("fadeIn fast");
                $("#bigBox"+TimedID).addClass("fadeOut fast").delay(300).queue(function()
                {
                    $(this).clearQueue();
                    $(this).remove();
                });

                $("#miniIcon"+TimedID).removeClass("fadeIn fast");
                $("#miniIcon"+TimedID).addClass("fadeOut fast").delay(300).queue(function()
                {
                    $(this).clearQueue();
                    $(this).remove();
                });

            }, settings.timeout); 
        }

    }
})(jQuery);

// .BigBox


// Small Notification
var SmallBoxes = 0;
var SmallCount = 0;
var SmallBoxesAnchos = 0;
var ColorTimeInterval;


(function ($) {
    $.smallBox = function (settings,callback) 
    {
        var BoxSmall, content;
        settings = $.extend({
            title: "",
            content: "",
            img: undefined,
            icon: undefined,
            sound: true,
            color: undefined,
            timeout: undefined,
            colortime: 1500,
            colors:undefined
        }, settings);


        // SmallBox Sound
        if(settings.sound===true)
        {
            if(isIE8orlower() == 0)
            {
                var audioElement = document.createElement('audio');

                if (navigator.userAgent.match('Firefox/'))
                    audioElement.setAttribute('src', 'static/sound/smallbox.ogg');
                else
                    audioElement.setAttribute('src', 'static/sound/smallbox.mp3');
                
                
                $.get();
                audioElement.addEventListener("load", function() {
                audioElement.play();
                }, true);
                audioElement.pause();
                audioElement.play();
            }
        }
         

        SmallBoxes = SmallBoxes + 1;

        BoxSmall = ""

        

        // <div class="SmallBox animated fadeInRight fast">
        //     <div class="foto">
        //         <img src="static/img/pic1.png"> 
        //     </div>

        //     <div class="textoFoto">
        //         <span>Hola Mundo</span>
        //         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. lorem</span>
        //     </div>
        //     <div class='miniIcono'>
        //           <img class='miniPic' src='static/img/talk.png'>
        //     </div>
        // </div>
        var IconSection ="";
        var CurrentIDSmallbox = "smallbox"+SmallBoxes;

        if(settings.icon == undefined)
        {
            IconSection = "<div class='miniIcono'></div>";
        }
        else
        {
            IconSection = "<div class='miniIcono'><i class='"+ settings.icon +"'></i></div>";
        }

        if(settings.img == undefined)
        {
            BoxSmall = "<div id='smallbox"+ SmallBoxes +"' class='modal-content SmallBox animated fadeInRight fast'><div class='modal-body textoFull'><span>"+ settings.title +"</span><p>"+ settings.content +"</p></div>"+ IconSection +"</div>";   
        }
        else
        {
            BoxSmall = "<div id='smallbox"+ SmallBoxes +"' class='modal-content SmallBox  animated fadeInRight fast'><div class='foto'><img src='"+ settings.img +"' style='width:100px;height:100px'></div><div class='modal-body textoFoto '><span>"+ settings.title +"</span><p>"+ settings.content +"</p></div>"+ IconSection +"</div>";
        }

        if(SmallBoxes == 1)
        {
            $("#divSmallBoxes").append(BoxSmall);
            SmallBoxesAnchos = $("#smallbox"+SmallBoxes).height() + 40;
        }
        else
        {
            var MetroExist = $(".SmallBox").size();
            if(MetroExist==0)
            {
                $("#divSmallBoxes").append(BoxSmall);
                SmallBoxesAnchos = $("#smallbox"+SmallBoxes).height() + 40;
            }
            else
            {
                $("#divSmallBoxes").append(BoxSmall);
                $("#smallbox"+SmallBoxes).css("top", SmallBoxesAnchos );
                SmallBoxesAnchos = SmallBoxesAnchos + $("#smallbox"+ SmallBoxes).height() + 20;
                
                $(".SmallBox").each(function( index ) 
                {   

                    if(index == 0)
                    {
                        $(this).css("top", 20 );
                        heightPrev = $(this).height() + 40;
                        SmallBoxesAnchos = $(this).height() + 40;
                    }
                    else
                    {
                        $(this).css("top", heightPrev );
                        heightPrev = heightPrev + $(this).height() + 20;
                        SmallBoxesAnchos = SmallBoxesAnchos + $(this).height() + 20;
                    }

                });
                
            } 
        }

        var ThisSmallBox = $("#smallbox"+SmallBoxes);
        

        // IE fix
        // if($.browser.msie)
        // {
        //     // alert($("#"+CurrentIDSmallbox).css("height"));
        // }



        if(settings.color == undefined)
        {
            //ThisSmallBox.css("background-color", "#004d60" );
        }
        else
        {
            ThisSmallBox.css("background-color", settings.color );
        }

        //Colors
        clearInterval(ColorTimeInterval);
        if(settings.colors !=undefined && settings.colors.length>0){
            ThisSmallBox.attr("colorcount","0");

            ColorTimeInterval = setInterval(function(){

                var ColorIndex = ThisSmallBox.attr("colorcount");

                ThisSmallBox.animate({
                    backgroundColor: settings.colors[ColorIndex].color,
                });

                if(ColorIndex < settings.colors.length-1){
                    ThisSmallBox.attr("colorcount",((ColorIndex*1)+1));
                }else{
                    ThisSmallBox.attr("colorcount",0);
                }

            },settings.colortime);
        }


        if(settings.timeout != undefined)
        {

            setTimeout(function() 
            {
                clearInterval(ColorTimeInterval);
                var ThisHeight = $(this).height() + 20;
                var ID = CurrentIDSmallbox;
                var ThisTop = $("#"+CurrentIDSmallbox).css('top');

                // SmallBoxesAnchos = SmallBoxesAnchos - ThisHeight;
                // $("#"+CurrentIDSmallbox).remove();

                if ($("#"+CurrentIDSmallbox+":hover").length != 0) {
                    //Mouse Over the element
                    $("#"+CurrentIDSmallbox).on("mouseleave",function(){
                        SmallBoxesAnchos = SmallBoxesAnchos - ThisHeight;
                        $("#"+CurrentIDSmallbox).remove();
                        if (typeof callback == "function") 
                        {   
                            if(callback) callback();
                        }
                        
                        var Primero = 1;
                        var heightPrev = 0;
                        $(".SmallBox").each(function( index ) 
                        {   

                            if(index == 0)
                            {
                                $(this).animate({
                                    top: 20 
                                },300);

                                heightPrev = $(this).height() + 40;
                                SmallBoxesAnchos = $(this).height() + 40;
                            }
                            else
                            {
                                $(this).animate({
                                    top: heightPrev 
                                },350);

                                heightPrev = heightPrev + $(this).height() + 20;
                                SmallBoxesAnchos = SmallBoxesAnchos + $(this).height() + 20;
                            }

                        });
                    });
                }
                else
                {
                    clearInterval(ColorTimeInterval);
                    SmallBoxesAnchos = SmallBoxesAnchos - ThisHeight;
                    
                    if (typeof callback == "function") 
                    {   
                        if(callback) callback();
                    }

                    $("#"+CurrentIDSmallbox).removeClass().addClass("SmallBox").animate({
                        opacity: 0
                    },300, function(){

                        $(this).remove();
                        
                         var Primero = 1;
                            var heightPrev = 0;
                            $(".SmallBox").each(function( index ) 
                            {   

                                if(index == 0)
                                {
                                    $(this).animate({
                                        top: 20 
                                    },300);

                                    heightPrev = $(this).height() + 40;
                                    SmallBoxesAnchos = $(this).height() + 40;
                                }
                                else
                                {
                                    $(this).animate({
                                        top: heightPrev 
                                    });

                                    heightPrev = heightPrev + $(this).height() + 20;
                                    SmallBoxesAnchos = SmallBoxesAnchos + $(this).height() + 20;
                                }

                            });  
                    })
                }
                


            }, settings.timeout); 
        }
        
        // Click Closing
         $("#smallbox"+SmallBoxes).bind('click', function() 
         {
            clearInterval(ColorTimeInterval);
            if (typeof callback == "function") 
            {   
                if(callback) callback();
            }

            var ThisHeight = $(this).height() + 20;
            var ID = $(this).attr('id');
            var ThisTop = $(this).css('top');

            SmallBoxesAnchos = SmallBoxesAnchos - ThisHeight;
            

            $(this).removeClass().addClass("SmallBox").animate({
                opacity: 0
            },300,function(){
                $(this).remove();

                var Primero = 1;
                var heightPrev = 0;

                $(".SmallBox").each(function( index ) 
                {   

                    if(index == 0)
                    {
                        $(this).animate({
                            top: 20,
                        },300);
                        heightPrev = $(this).height() + 40;
                        SmallBoxesAnchos = $(this).height() + 40;
                    }
                    else
                    {
                        $(this).animate({
                            top:heightPrev 
                        },350);
                        heightPrev = heightPrev + $(this).height() + 20;
                        SmallBoxesAnchos = SmallBoxesAnchos + $(this).height() + 20;
                    }

                });  
            })



            
         });
            
        
    }
})(jQuery);



// .Small Notification



function getInternetExplorerVersion() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}
function checkVersion() {
    var msg = "You're not using Windows Internet Explorer.";
    var ver = getInternetExplorerVersion();
    if (ver > -1) {
        if (ver >= 8.0)
            msg = "You're using a recent copy of Windows Internet Explorer."
        else
            msg = "You should upgrade your copy of Windows Internet Explorer.";
    }
    alert(msg);
}

function isIE8orlower() {
    var msg = "0";
    var ver = getInternetExplorerVersion();
    if (ver > -1) {
        if (ver >= 9.0)
            msg = 0
        else
            msg = 1;
    }
    return msg;
    // alert(msg);
}