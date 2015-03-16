Manifesto is a Bookmarklet that runs in HTML5 compliant browsers and checks the status of the current page's Offline Web Application Cache, if it has one.  If a manifest file is specified but not working, the bookmarklet attempts to identify common problems, including syntax errors and referenced files that do not exist or are not accessible.

## See the [Manifesto Homepage](http://manifesto.ericdelabar.com/) for the installable bookmarklet ##

To install the current development bookmarklet create a bookmark with the following url (one line):

```
javascript:(function(){if(window.applicationCache){if(window.applicationCache.status==window.applicationCache.UNCACHED){cmc=document.createElement('SCRIPT');
cmc.type='text/javascript';cmc.src='http://manifesto.googlecode.com/hg/manifesto.js?x='+(Math.random());document.getElementsByTagName('head')[0].appendChild
(cmc);}else{alert('Manifest file is valid.');}}else{alert('This browser does not support HTML5 Offline Application Cache.');}})();
```

### Test URLs ###
  * [Working Cache](http://manifesto.ericdelabar.com/tests/good.html)
  * [Invalid Cache](http://manifesto.ericdelabar.com/tests/invalid.html)
  * [Empty Cache](http://manifesto.ericdelabar.com/tests/empty.html)
  * [Bad Cache Entries](http://manifesto.ericdelabar.com/tests/bad.html)

### Currently tested and working on: ###
  * Safari 5.0.2 on OSX 10.6.4
  * Chrome 6.0.472.55 on OSX 10.6.4
  * Firefox 3.6.3 on OSX 10.6.4
  * Opera 10.62 build 8437 on OSX 10.6.4

### Promote JS! ###
<a href='https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/RegExp' title='JavaScript RegExp .source'><img src='http://static.jsconf.us/promotejsh.gif' alt='JavaScript RegExp .source' height='150' width='180' /></a>