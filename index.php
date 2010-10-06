<!doctype html>
<?php 
$isiOS = ( (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad') || (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') ) || ( (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod') );
$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
$isAndroid = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
$isMobileSafari = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Safari');

$handle = fopen("bookmarklet.js", "r");
$src = fgets( $handle );
$src = preg_replace( "/\s/i" , "%20", $src );
$src = preg_replace( '/"/i' , "%22", $src );
$src = preg_replace( "/'/i" , "%27", $src );

$bookmarklet = 'javascript:'.$src;
?>
<html lang="en" class="<?php if($isiOS) echo " ios "; if($isAndroid) echo " android "; if($isMobileSafari) echo " mobilesafari "; if($isMobileSafari) echo " ipad "; ?>">
	<head>
		<link href='http://fonts.googleapis.com/css?family=Neuton|Cantarell:regular,italic,bold' rel='stylesheet' type='text/css'>
		
		<meta charset="utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="format-detection" content="telephone=no" />
		

		<title>Manifesto - An HTML5 Offline Application Cache verification bookmarklet</title>
		<title>Manifesto</title>
		<meta name="description" content="Manifesto is a bookmarklet for quickly verifying that an HTML5 manifest file is valid and working.">
		<meta name="author" content="Eric DeLabar">
  	
  	<?php if( $isiPad ) { ?>
  	<meta name="viewport" id="viewport" content="width=device-width; initial-scale=0.8; maximum-scale=1.0;">
  	<?php } else { ?>
  	<meta name="viewport" id="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  	<?php } ?>
  	
		<link rel="shortcut icon" href="/favicon.ico">

  	<link rel="stylesheet" href="css/style.css?v=2">
  	<link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">
  	<script src="js/modernizr-1.5.min.js"></script>
		
		<link rel="alternate" href="https://code.google.com/feeds/p/manifesto/updates/basic" title="Project Updated (Atom)" type="application/atom+xml" />
		<link rel="alternate" href="https://code.google.com/feeds/p/manifesto/issueupdates/basic" title="Issue Updates (Atom)" type="application/atom+xml" />
		<link rel="alternate" href="https://code.google.com/feeds/p/manifesto/hgchanges/basic" title="Mercurial Commits (Atom)" type="application/atom+xml" />
	</head>	
	<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
	<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
	<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
	<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<body>
		<!--<![endif]-->
		<div id="container">
	    <header>
				<h1>Manifesto</h1>
				<h2>is an HTML5 Offline Application Cache verification bookmarklet</h2>
	    </header>
	    
	    <article id="main">
	
				<img src="images/screenshot-whole.png" alt="Screenshot of manifesto" class="screenshot"/>
				<p>Manifesto provides a quick and easy way to make sure your HTML5 manifest file is valid and working on your page.</p>
				<p>One of the hardest parts of the Offline Application Cache is that when it doesn't work, it fails silently and you may not even realize it.  This bookmarklet provides a simple way to make sure your page is using the manifest, and if it's not, it tries to help you diagnose the problem.</p>
				<p>Manifesto identifies files that can't be accessed, manifest file syntax errors, duplicate listings, and warns about common pain points.</p>
				<p>Sound helpful?</p>
				<h3>Install the Bookmarklet</h3>
				<div class="desktop">
					<p><a href="<?php echo $bookmarklet;?>" class="bookmarklet"><span>Manifesto</span></a><span class="instructions">☚ Drag this to your bookmarks bar.</span></p>
				</div>
				<div class="ios">
					<p>Since you're already on your mobile device, follow these instructions.  If that sounds too complicated, read the paragraph after the instructions.</p>
					<ol>
						<li>Copy all of this code to the clipboard:<textarea><?php echo $bookmarklet;?></textarea></li>
						<li>Tap the "+" icon in the menu bar and choose "Add Bookmark"</li>
						<li>Change the first field to something useful like "Manifesto bookmarklet"</li>
						<li>Tap the "Save" button</li>
						<li>Tap the book icon to bring up your bookmarks.  Navigate to the bookmark folder where you saved the bookmark</li>
						<li>Tap the "Edit" button and tap the "Manifesto" bookmark you just created</li>
						<li>Tap the second field, the one that says <code>http://manifesto.ericdelabar.com/</code>, and press the 'x' icon to clear it</li>
						<li>Paste the code copied in step 1 into the box.</li>
						<li>Tap the button in the upper left to take you back and tap "done"</li>
						<li>Navigate to the offline-enabled page of your choice and tap the "Manifesto" bookmarklet to launch.</li>
					</ol>
					<p>Alternately, open this page in Safari on your desktop, install the bookmarklet, and use either MobileMe bookmarklet syncing or iTunes to sync the bookmarklet to your iOS device.</p>
				</div>
				<h3>Try it Out</h3>
				<ul>
					<li>Test a <a href="tests/good.html">Working Manifest</a> file.</li>
					<li>Test an <a href="tests/empty.html">Empty Manifest</a> file.</li>
					<li>Test an <a href="tests/invalid.html">Invalid Manifest</a> file ("CACHE MANIFEST" is not the first line).</li>
					<li>Test a <a href="tests/bad.html">Bad Manifest</a> file (multiple errors with contents).</li>
				</ul>
				<h3>Contribute</h3>	
				
				<p>Manifesto is Open Source and released under the <a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License v3</a>.
				<a href="https://code.google.com/p/manifesto/source/checkout">Clone Manifesto</a> on <a href="https://code.google.com/p/manifesto">Google Code</a> if you're interested in contributing.</p>
				
				<h3>Enjoy!</h3>
				
				<aside>
					<h4>Tested on:</h4>
					<ul class="platforms">
						<li><a href="http://www.apple.com/safari/download/"><img src="/images/logo-safari.png" alt="Safari Logo"/></a><a href="http://www.apple.com/safari/download/">Safari</a><span class="version">5.0.2 (Mac)</span><span class="version">5.0.2 (Win)</span></li>
						<li><a href="http://www.mozilla.com/en-US/firefox/firefox.html"><img src="/images/logo-firefox.png" alt="Firefox Logo"/></a><a href="http://www.mozilla.com/en-US/firefox/firefox.html">Firefox</a><span class="version">3.6.3 (Mac)</span><span class="version">3.6.10 (Win)</span></li>
						<li><a href="http://www.google.com/chrome/"><img src="/images/logo-chrome.png" alt="Chrome Logo"/></a><a href="http://www.google.com/chrome/">Chrome</a><span class="version">6.0.472.55 (Mac)</span><span class="version">6.0.472.59 (Win)</span></li>
						<li><a href="http://www.opera.com/"><img src="/images/logo-opera.png" alt="Opera Logo"/></a><a href="http://www.opera.com/">Opera</a><span class="version">10.62 (Mac)</span><span class="version">10.62 (Win)</span></li>
						<!--<li><a href="http://ie.microsoft.com/testdrive/"><img src="/images/logo-ie.png" alt="Internet Explorer Logo"/></a><a href="http://ie.microsoft.com/testdrive/">Internet Explorer</a><span class="version">9 Preview (Win)</span></li>-->
						<!--<li><a href="http://www.apple.com/iphone/ios4/"><img src="/images/logo-ios.png" alt="iOS Logo"/></a><a href="http://www.apple.com/iphone/ios4/">iOS</a><span class="version">4.1 (iPhone)<br/>3.2 (iPad)</span></li>-->
					</ul>
					<h4>Works with:</h4>
					<ul class="frameworks">
						<li><a href="http://www.jquery.org/"><img src="/images/logo-jquery.png" alt="jQuery Logo"/></a><a href="http://www.jquery.org/">jQuery</a></li>
						<li><a href="http://www.prototypejs.org/"><img src="/images/logo-prototype.png" alt="Prototype Logo"/></a><a href="http://www.prototypejs.org/">Prototype</a></li>
						<!--<li><a href="http://www.jqtouch.com/"><img src="/images/logo-jqtouch.png" alt="jQTouch Logo"/></a><a href="http://www.jqtouch.com/">jQTouch</a></li>-->
					</ul>
					<p>Need support for a browsing platform or JavaScript Framework? <a href="https://code.google.com/p/manifesto/issues/list">Open an issue</a> on the <a href="https://code.google.com/p/manifesto">Manifesto Google Code project page</a>.</p>
				</aside>
	    </article>
	    
	    <footer>
				<p>Do you like <strong>Manifesto</strong> for mobile development?  Try <a href="http://snoopy.allmarkedup.com/">Snoopy</a> a bookmarklet by <a href="http://twitter.com/allmarkedup">Mark Perkins</a> that lets you view-source in Mobile Webkit.</p>
    		<div>
    			<p><strong>Manifesto</strong> is designed and developed by <a href="http://www.ericdelabar.com/">Eric DeLabar</a> (<a href="http://twitter.com/edelabar">@edelabar</a>). Updates and other notification through <a href="https://code.google.com/p/manifesto/feeds">Google Code</a>.</p>
    			<div class="promotejs"><a href='https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/String' title='JavaScript String .match'><img src='http://static.jsconf.us/promotejsh.gif' height='150' width='180' alt='JavaScript String .match'/></a></div>
    		</div>
			</footer>
  	</div> <!-- end of #container -->
  	
		<div id="noSupport">
			<h1>Sorry, Manifesto requires a browser with HTML5 Application Cache support.</h1>
			<p>The HTML5 Application Cache works in the latest version of <a href="http://www.google.com/chrome/">Chrome</a>, <a href="http://www.apple.com/safari/download/">Safari</a>, <a href="http://www.mozilla.com/en-US/firefox/firefox.html">Firefox</a>, and <a href="http://www.opera.com/">Opera</a>.  Normally I'd make this page work for other browsers, but since this is a development tool, frankly, there's no point.</p>
			<p>Manifesto is Open Source and released under the <a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License v3</a>.
			<a href="https://code.google.com/p/manifesto/source/checkout">Clone Manifesto</a> on <a href="https://code.google.com/p/manifesto">Google Code</a> if you're interested in contributing.</p>
			<div class="promotejs"><a href='https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/String' title='JS String .replace'><img src='http://static.jsconf.us/promotejsv.gif' height='280' width='160' alt='JS String .replace'/></a></div>
		</div>
		
		<div id="mobileNoSupport">
			<h1>Sorry, your browser doesn't support bookmarklets.</h1>
			<p>Last I checked the version of Mobile Safari on Android phones did not support <code>javascript:</code>-type bookmarks, otherwise known as bookmarklets.  If you know otherwise, or have a work-around please file a bug on the Google Code issues page letting me know how.  Thanks!</p>
			<p>Manifesto is Open Source and released under the <a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License v3</a>.
			<a href="https://code.google.com/p/manifesto/source/checkout">Clone Manifesto</a> on <a href="https://code.google.com/p/manifesto">Google Code</a> if you're interested in contributing.</p>
			<div class="promotejs"><a href='https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Array' title='JS Array .shift'><img src='http://static.jsconf.us/promotejsh.gif' height='150' width='180' alt='JS Array .shift'/></a></div>
		</div>

	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	  <script>!window.jQuery && document.write('<script src="js/jquery-1.4.2.min.js"><\/script>')</script>
	  <script src="js/plugins.js?v=1"></script>
	  <script src="js/script.js?v=2"></script>
	
	  <!--[if lt IE 7 ]>
	    <script src="js/dd_belatedpng.js?v=1"></script>
	  <![endif]-->

		<script>
	   var _gaq = [['_setAccount', 'UA-18491841-1'], ['_trackPageview']]; 
	   (function(d, t) {
	    var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
	    g.async = true; g.src = '//www.google-analytics.com/ga.js'; s.parentNode.insertBefore(g, s);
	   })(document, 'script');
	  </script>
	</body>
</html>