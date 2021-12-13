import {h, render} from 'preact';

let App = function() {
    return (
        
            'Hello world!'
        
    )
}

render(App, document.getElementById('app'));


// PWA
if ('serviceWorker' in navigator) {
	window.addEventListener('load', () => {
		navigator.serviceWorker.register('./service-worker.js').then(
			registration => {
				console.log(`ServiceWorker registration successful with scope: ${registration.scope}`);
			},
			error => {
				console.log(`ServiceWorker registration failed: ${error}`);
			}
		);
	});
}
