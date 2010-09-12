var jQuery=jQuery;var $=$;var c=console;if(!c){c={};c.log=function(a){}}var secure="https:"==document.location.protocol;css=document.createElement("LINK");css.rel="stylesheet";css.type="text/css";css.href="http://manifesto.ericdelabar.com/manifesto.css";document.getElementsByTagName("head")[0].appendChild(css);if(!jQuery){jq=document.createElement("SCRIPT");jq.type="text/javascript";jq.src="http"+(secure?"s":"")+"://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js";document.getElementsByTagName("head")[0].appendChild(jq)}var interval;var intervalFn=function(){if(jQuery){if(jQuery&&$&&jQuery!=$){jQuery.noConflict()}jQuery(document).ready(function(h){var f={};f[404]="NOT FOUND";f[500]="INTERNAL SERVER ERROR";var b=h("html").attr("manifest");if(b){var i=h("body").append('<div id="cacheStatus" style="display:none;"><p><strong>Manifesto v1.0</strong>Status: <span></span></p><div id="formatted"><table><tbody></tbody></table></div><div id="raw" style="display:none;"><pre></pre></div><p>By <a href="http://www.ericdelabar.com/">Eric DeLabar</a> see <a href="http://manifesto.ericdelabar.com/">http://manifesto.ericdelabar.com/</a> for details. </p></div>').find("#cacheStatus");var g=i.find("p > span");var d=i.find("div#raw pre");var k=i.find("div#formatted tbody");var a=window.applicationCache;var e=function(n){var l,m;switch(a.status){case a.UNCACHED:l="Uncached";m=true;break;case a.IDLE:l="Idle";break;case a.CHECKING:l="Checking";break;case a.DOWNLOADING:l="Downloading";break;case a.UPDATEREADY:l="Update Ready"}g.html(l);if(m){j()}};var j=function(l){d.load(b,function(){i.show();var x=d.html().split("\n");var q=10;var o=1;while(x.length>(q-1)){q=q*10;o++}var v=function(s){if(s.match(/^([^#]*)(# .*)$/)){return RegExp.$1+'<span class="comment">'+RegExp.$2+"</span>"}return s};var p=function(s){return function(y){var z=""+(y+1);while(z.length<s){z="0"+z}return z+":"}}(o);if(x[0].match(/^CACHE MANIFEST\s*(#.*)?/)){k.append("<tr><th>"+p(0)+'</th><td class="keyword">'+v(x[0])+"</td></tr>");if(x.length>1){var n="CACHE";for(var m=1;m<x.length;m++){k.append("<tr><th>"+p(m)+"</th><td>"+v(x[m])+"</td></tr>");var u=k.children().last();if(!x[m].match(/^\s*(#.*)?$/)){if(x[m].match(/^\s*([A-Z]+):\s*(#.*)?$/)){n=RegExp.$1;u.find("td").addClass("keyword")}else{var w;if(n=="CACHE"||n=="NETWORK"){if(x[m].match(/^\s*(\S*)\s*(#.*)?$/)){w=RegExp.$1;if(n=="CACHE"&&w.substr(0,1)=="*"){c.log("Line["+(m+1)+"]: Invalid syntax: "+x[m]);u.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");continue}else{if(n=="NETWORK"&&w.substr(0,1)=="*"){u.find("td").append('<span class="warn">Wildcard, verify manually.</span>').addClass("warn");continue}}}else{c.log("Line["+(m+1)+"]: Invalid syntax: "+x[m]);u.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");continue}}else{if(n=="FALLBACK"){if(x[m].match(/^\s*\S*\s*(\S*)\s*(#.*)?$/)&&RegExp.$1.substr(0,1)!="*"){w=RegExp.$1}else{c.log("Line["+(m+1)+"]: Invalid syntax: "+x[m]);u.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");continue}}}if(w.match(/^\s*https?:\/\/([^\/]+)\//)){var t=RegExp.$1;window.location.href.match(/^\s*https?:\/\/([^\/]+)\//);var r=RegExp.$1;if(t!=r){c.log("Line["+(m+1)+"]: Ignoring cross-site file (verify manually): "+w);u.find("td").append('<span class="warn">Off-site file, verify manually.</span>').addClass("warn");continue}}h.ajax({url:w,cache:false,dataType:"text",complete:function(y,s){c.log("Line["+(s+1)+"]: Attempting to GET url: "+y);return function(B,A){if(B.status!=200){c.log("Line["+(s+1)+"]: Error "+B.status+" retrieving URL: "+y);var z=h("div#formatted tbody").children().eq(s);z.find("td").append('<span class="error">'+B.status+" "+(f[B.status]?f[B.status]:"")+"</span>").addClass("error")}}}(w,m)})}}else{u.find("td").addClass("ignored")}}}}else{alert("Line 1 of "+b+" must be 'CACHE MANIFEST'")}})};a.addEventListener("cached",e,false);a.addEventListener("checking",e,false);a.addEventListener("downloading",e,false);a.addEventListener("update",e,false);a.addEventListener("progress",e,false);a.addEventListener("updateReady",e,false);a.addEventListener("error",e,false);e()}else{alert("Manifest file NOT specified.")}});clearInterval(interval)}};interval=setInterval(intervalFn,100);