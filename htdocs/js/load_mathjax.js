
window.MathJax = {
	loader: {
		load: ['ui/safe', 'input/asciimath', 'output/chtml']
	},
	options: {
		enableMenu: false,
		menuOptions: {
			settings: {
				collapsible: false
			}
		}
	},
	tex: {
		inlineMath:		[['$' , '$' ], ['\\(', '\\)']],
		displayMath:	[['$$', '$$'], ['\\[', '\\]']]
	}
};


{
	// let script = document.createElement('script');
	// script.src = "https://polyfill.io/v3/polyfill.min.js?features=es6";
	// script.defer = true;
	// document.head.appendChild(script);

	let script 		= document.createElement('script');
	script.src		= "https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js";
	script.async	= true;
	document.head.appendChild(script);
}

