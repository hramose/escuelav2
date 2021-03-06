(function(){
	'use strict';
	angular.module('escuela')
		.service('printer',service);

	function service(){
		var vm=this;

		// Funciones
		vm.div=div;

		function div(div,otherlink,cb){
	      var printContents = document.getElementById(div).innerHTML;
	      var newWindow = window.open("", "newWindow", "");
	      newWindow.document.write('<link rel="stylesheet" href="/js/node_modules/bootstrap/dist/css/bootstrap.min.css">');
	      newWindow.document.write('<link rel="stylesheet" href="/css/ng_animation.css">');
	      newWindow.document.write('<link rel="stylesheet" href="/css/app.css">');
	      newWindow.document.write('<link rel="stylesheet" href="/js/node_modules/ng-dialog/css/ngDialog.min.css">');
	      newWindow.document.write('<link rel="stylesheet" href="/js/node_modules/ng-dialog/css/ngDialog-theme-default.min.css">');
	      if (typeof otherlink!=='undefined') {
	      	for (var i = 0; i < otherlink.length; i++) {
	      		newWindow.document.write(otherlink[i]);
	      	}
	      }
	      newWindow.document.write(printContents);
	      setTimeout(function() {
	      	newWindow.print();
	      	newWindow.close();
	      	if(typeof cb==='function') cb(true);
	      }, 10);
		}
	}
})();   