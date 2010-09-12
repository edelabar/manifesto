var jQuery = jQuery;
var $ = $;
var c = c;
if( !c ) {
	c = {};
	c.log = function( msg ){};
}
var secure = 'https:' == document.location.protocol;
css=document.createElement('LINK');
css.rel='stylesheet';
css.type='text/css';
css.href='http://manifesto.ericdelabar.com/manifesto.css';
document.getElementsByTagName('head')[0].appendChild(css);

if( !jQuery ) {
	jq=document.createElement('SCRIPT');
  jq.type='text/javascript';
  jq.src='http'+( secure ? 's' : '')+'://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js';
  document.getElementsByTagName('head')[0].appendChild(jq);
}
var interval;
var intervalFn = function() {
	if( jQuery ) {
		if( jQuery && $ && jQuery != $ ) {
			jQuery.noConflict();
		}
		jQuery(document).ready(function($){
			var statusCodes = {};
			statusCodes[404] = "NOT FOUND";
			statusCodes[500] = "INTERNAL SERVER ERROR";
			var manifest = $('html').attr('manifest');
			if( manifest ) {
				var win = $('body').append('<div id="cacheStatus" style="display:none;"><p><strong>Manifesto v1.0</strong>Status: <span></span></p><div id="formatted"><table><tbody></tbody></table></div><div id="raw" style="display:none;"><pre></pre></div><p>By <a href="http://www.ericdelabar.com/">Eric DeLabar</a> see <a href="http://manifesto.ericdelabar.com/">http://manifesto.ericdelabar.com/</a> for details. </p></div>').find('#cacheStatus');
				var status = win.find( "p > span" );
				var manifestFile = win.find( "div#raw pre" );
				var display = win.find( "div#formatted tbody" );
				
				var cache = window.applicationCache;
				
				var statusFn = function(e){
					var s, err;
					switch( cache.status )
					{
					case cache.UNCACHED:
						s = "Uncached";
						err = true;
					  break;
					case cache.IDLE:
						s = "Idle";
					  break;
					case cache.CHECKING:
						s = "Checking";
					  break;
					case cache.DOWNLOADING:
						s = "Downloading";
					  break;
					case cache.UPDATEREADY:
						s = "Update Ready";
					}
					status.html( s );
					if( err ) {
						errorFn();
					}
				};
				
				var errorFn = function(e){
					manifestFile.load( manifest, function(){
						win.show();
						var lines = manifestFile.html().split('\n');
						var pow = 10;
						var padLength = 1;
						while( lines.length > ( pow - 1 ) ) {
							pow = pow * 10;
							padLength++;
						}
						var parseComments = function( str ) {
							if( str.match(/^([^#]*)(# .*)$/) ) {
								return RegExp.$1 + '<span class="comment">' + RegExp.$2 + '</span>';
							}
							return str;
						}
						var padFn = function( padLength ){
							return function( index ) {
								var s = '' + ( index + 1);
								while( s.length < padLength ) {
									s = '0' + s;
								}
								return s + ":";
							}
						}( padLength );
						c.log( "Pad Length: " + padLength );
						if( lines[0].match(/^CACHE MANIFEST\s*(#.*)?/) ) { // 'CACHE MANIFEST' CANNOT have whitespace before it.
							display.append( "<tr><th>" + padFn( 0 ) + '</th><td class="keyword">' + parseComments( lines[0] ) + "</td></tr>" );
							if( lines.length > 1 ) {
								var mode = "CACHE";
								for( var i = 1; i < lines.length; i++ ) {
									display.append( "<tr><th>" + padFn( i ) + "</th><td>" + parseComments( lines[i] ) + "</td></tr>" );
									var currentLine = display.children().last();
									if( !lines[i].match(/^\s*(#.*)?$/) ) { // Whitespace before OK
										if( lines[i].match(/^\s*([A-Z]+):\s*(#.*)?$/) ) { // Whitespace before OK
											mode = RegExp.$1;
											currentLine.find("td").addClass("keyword");
										} else {
											var s;
											if( mode == 'CACHE' || mode == 'NETWORK' ) {
												if( lines[i].match(/^\s*(\S*)\s*(#.*)?$/) ) { // Whitespace before OK
													s = RegExp.$1
													if( mode == 'CACHE' && s.substr(0,1) == '*' ) {
														c.log( "Line["+(i+1)+"]: Invalid syntax: " + lines[i] );
														currentLine.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");
														continue;
													} else if( mode == 'NETWORK' && s.substr(0,1) == '*' ) {
														currentLine.find("td").append('<span class="warn">Wildcard, verify manually.</span>').addClass("warn");
														continue;
													}
												} else {
													c.log( "Line["+(i+1)+"]: Invalid syntax: " + lines[i] );
													currentLine.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");
													continue;
												}
											} else if( mode == 'FALLBACK' ) {
												if( lines[i].match(/^\s*\S*\s*(\S*)\s*(#.*)?$/) && RegExp.$1.substr(0,1) != '*' ) { // Whitespace before OK
													s = RegExp.$1
												} else {
													c.log( "Line["+(i+1)+"]: Invalid syntax: " + lines[i] );
													currentLine.find("td").append('<span class="error">Invalid Syntax!</span>').addClass("error");
													continue;
												}
											}
											if( s.match(/^\s*https?:\/\/([^\/]+)\//) ) { // Whitespace before OK
												var link = RegExp.$1;
												window.location.href.match(/^\s*https?:\/\/([^\/]+)\//); // Whitespace before OK
												var root = RegExp.$1;
												if( link != root ) {
													c.log( "Line["+(i+1)+"]: Ignoring cross-site file (verify manually): " + s );
													currentLine.find("td").append('<span class="warn">Off-site file, verify manually.</span>').addClass("warn");
													continue;
												}
											}
											$.ajax({
												url: s,
												cache: false,
												dataType: 'text',
												complete: function(url, line){ 
													c.log( "Line["+(line+1)+"]: Attempting to GET url: " + url );
													return function( XHR, status ) {
														if (XHR.status != 200) {
															c.log("Line["+(line+1)+"]: Error " + XHR.status + " retrieving URL: " + url );
															var cl = $( "div#formatted tbody" ).children().eq(line);
															cl.find("td").append('<span class="error">'+XHR.status+' ' + ( statusCodes[XHR.status] ? statusCodes[XHR.status] : ""  ) + '</span>').addClass("error");
														}
													};
												}( s, i )
											});
										}
									} else {
										currentLine.find("td").addClass("ignored");
									}
								}
							}
						} else {
							alert( "Line 1 of "  + manifest + " must be 'CACHE MANIFEST'" );
						}
					
					});
					
				};
				
				cache.addEventListener('cached', statusFn, false);
				cache.addEventListener('checking', statusFn, false);
				cache.addEventListener('downloading', statusFn, false);
				cache.addEventListener('update', statusFn, false);
				cache.addEventListener('progress', statusFn, false);
				cache.addEventListener('updateReady', statusFn, false);
				cache.addEventListener('error', statusFn, false);
				statusFn();
			} else {
				alert( 'Manifest file NOT specified.' );
			}
		});
		clearInterval( interval );
	}
}
interval = setInterval( intervalFn, 100 ); 