(function(){
	if( window.applicationCache ) { 
		if( window.applicationCache.status == window.applicationCache.UNCACHED ) {
			cmc=document.createElement('SCRIPT');
			cmc.type='text/javascript';
			cmc.src='http://manifesto.ericdelabar.com/manifesto.js?x='+(Math.random());
			document.getElementsByTagName('head')[0].appendChild(cmc);
		} else { 
			alert( 'Manifest file is valid.' ); 
		}
	} else { 
		alert( 'This browser does not support HTML5 Offline Application Cache.' ); 
	}
})();