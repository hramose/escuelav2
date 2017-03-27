(function(){
	'use strict';
	angular.module('escuela')
	.factory('AuthdeviceFactory',factory);

	function factory($http){
		var fc={
            url: 'api/authdevice',
			gDt: gDt,
			gDts: gDts,
            gSDt: gSDt,
            gRDts: gRDts,
            aDt: aDt,
			mDt: mDt,
            dDt: dDt,
            sStatus: sStatus
		};

		return fc;

		/////////////////
        function gDt(id){
            return $http.get(fc.url+'/'+id);
        }
        function gDts(){
            return $http.get(fc.url);
        }
        function gSDt(texto){
            return $http.get(fc.url+'/search/'+texto);
        }
        function gRDts(first){
            return $http.get(fc.url+'/range/'+first);
        }
        function aDt(data){
            return $http.post(fc.url,data);
        }
        function mDt(id,data){
            return $http.put(fc.url+'/'+id,data);
        }
        function dDt(id){
            return $http.delete(fc.url+'/'+id);
        }
        function sStatus(id){
            return $http.post(fc.url+'/status/'+id);
        }      
	}
})();