(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('CursYMatCtrl',controller);

	function controller(animPage, AniosFactory, NivelesHasAniosFactory, Saver, $timeout, $window, $rootScope){
		var vm=this;

		// Variables básicas
		vm.anios=[];
		vm.sel={
			anio: 0,
			per: null,
			type: 'mat'		};
		vm.datosRaw=[];
		vm.status={}; // De donde se grafica


		vm.selecData={};
		vm.ahora=new Date();
		vm.ahora=moment(vm.ahora);
		vm.limite={
			mora: 45,
			retraso: 35
		};

		
		vm.cargando=false;
			
		// Funciones basicas
		vm.periodos=periodos;
		vm.cambioAnio=cambioAnio;
		vm.mostrarGraficos=mostrarGraficos;
		vm.alprimero=alprimero;


		// Lanzamiento Automático
		animPage.show('cursymat',function(){
			activate();
		});

		/////////////////////////// FUNCIONES BASICAS //////////////////////////////
		function activate(){
			initObjeto();
			getAnios();
		}
 		function initObjeto(){
 			vm.status={
				mat:{
					name:[],
					value:[],
					promCurso:[],
				},
				cur:{
					name:[],
					value:[],
					filtroMateria:[],
				}
			};
 		}
 		function alprimero(){}
 		function getAnios(){
 			$rootScope.$broadcast('cargando',true);
 			return AniosFactory.gDts().then(function(res){
 				$rootScope.$broadcast('cargando',false);
 				vm.cargando=false;
 				vm.anios=res.data;
 			},function(e){
 				$rootScope.$broadcast('cargando',false);
 				$window.alert('El servidor presenta molestias en la conexión.');
 				console.log(e);
 			});
 		}
 		function periodos(){
 			for (var i = 0; i < vm.anios.length; i++) {
 				if(vm.anios[i].id==vm.sel.anio){
 					return vm.anios[i].periodos;
 				}
 			}
 			return [];
 		}
 		function cambioAnio(){
 			$rootScope.$broadcast('cargando',true);
 			initObjeto();
 			return NivelesHasAniosFactory.gNNAl(vm.sel.anio,vm.sel.per).then(function(res){
 				$rootScope.$broadcast('cargando',false);
 				vm.datosRaw=res.data;
 				calcularDatos(vm.datosRaw);
 				//mostrarGraficos();
 			},function(e){
 				$rootScope.$broadcast('cargando',false);
 				$window.alert('El servidor presenta molestias en la conexión.');
 				console.log(e);
 			});
 		}
 		function mostrarGraficos(){
 			if (vm.sel.type=='mat') {
 				dibujaGrafico('Rendimiento académico por Materia.',vm.status.mat);
 			}else{
 				dibujaGrafico('Rendimiento académico por Curso.',vm.status.cur);
 			}
 		}
 		function calcularDatos(dts){
 			let materiasDisponibles=[];
 			let idcursos=[];
 			for (var i = 0; i < dts.length; i++) { // Por cada nivel
 				let promcur=0;
 				var mats=[]; // Separador de materias por curso
 				var matname=[];
 				var matvaluepasa=[];
 				var matvaluenopasa=[];
 				for (var j = 0; j < dts[j].materias_has_niveles.length; j++) { // Por cada materia
 					// Extracción de notas promedio por periodos
 					let prommat=0;
 					var filtro={p:[], np:[]};
 					for (var k = 0; k < dts[i].materias_has_niveles[j].materias_has_periodos[0].alumnos_has_periodos.length; k++) {
 						var alumno=dts[i].materias_has_niveles[j].materias_has_periodos[0].alumnos_has_periodos[k];
 						var notaact=parseFloat(alumno.prom);
 						prommat += notaact;
 						if (notaact >= 3) {// Filtro de nota. De 3 en adelante.
 							filtro.p.push(alumno); // Pasa
 						} else {
 							filtro.np.push(alumno); // No pasa
 						} 
 					}
 					dts[i].materias_has_niveles[j].pasan=filtro.p; // Alumnos que pasan
 					dts[i].materias_has_niveles[j].nopasan=filtro.np; // alumnos que no pasan
 					mats.push({curso: i, mat: j});
 					matname.push(dts[i].materias_has_niveles[j].materias.nombre);
 					matvaluepasa.push(dts[i].materias_has_niveles[j].pasan.length);
 					matvaluenopasa.push(dts[i].materias_has_niveles[j].nopasan.length);
 					let divisor= dts[i].materias_has_niveles[j].materias_has_periodos[0].alumnos_has_periodos.length;
 					// Guardamos el promedio de la materia para todos los alumnos del curso.
 					dts[i].materias_has_niveles[j].prom= prommat / (divisor !== 0? divisor : 1);
 					promcur += dts[i].materias_has_niveles[j].prom;
 					// Acumular las materias disponibles para sus promedios unicos posteriores
 					materiasDisponibles.push({
 						id: dts[i].materias_has_niveles[j].materias.id, 
 						nombre:dts[i].materias_has_niveles[j].materias.nombre, 
 						prom: dts[i].materias_has_niveles[j].prom,
 						curso: dts[i].niveles.nombre,
 						posmats : {curso: i, mat: j}
 					});
 					idcursos.push(dts[i].materias_has_niveles[j].materias.id);
 				}
 				let divis= dts[j].materias_has_niveles.length;
 				dts[i].prom= promcur / (divis !== 0? divis : 1);
 				vm.status.cur.name.push(dts[i].niveles.nombre); // Nombre Niveles
 				vm.status.cur.value.push(dts[i].prom); // Promedio por nivel.
 				vm.status.cur.filtroMateria.push({
 					nivelid:dts[i].id,
 					posmats: mats, // Posiciones de materias
 					name: matname,
 					value: matvaluepasa,
 					value2: matvaluenopasa, //Para verificar integracion de dos barras. TODO
 				}); // Materias en curso.
 			}
 			let materias=idcursos.filter(function(value, index, self) { 
			    return self.indexOf(value) === index;
			});
			materias.sort(function(a, b){return a-b;}); // Organización numérica ascendente
			//let objMat=[];
			for (var i = 0; i < materias.length; i++) {
				let cuentael=0;
				vm.status.mat.name.push('');
				vm.status.mat.value.push(0);
				vm.status.mat.promCurso.push({
					posmats: [],
					name:[],
					value:[],
				});
				for (var j = 0; j < materiasDisponibles.length; j++) {
					if(materias[i]==materiasDisponibles[j].id){
						cuentael ++;
						vm.status.mat.name[i]=materiasDisponibles[j].nombre;
						vm.status.mat.value[i] += materiasDisponibles[j].prom;
						vm.status.mat.promCurso[i].posmats.push(materiasDisponibles[j].posmats);
						vm.status.mat.promCurso[i].name.push(materiasDisponibles[j].curso);
						vm.status.mat.promCurso[i].value.push(materiasDisponibles[j].prom);
					}
				}
				vm.status.mat.value[i] /= (cuentael>0? cuentael : 1);
			}
			console.log('Status:',vm.status);
 			mostrarGraficos();
 		}
 		function dibujaGrafico(title,data,callback,container){
 			if (typeof callback=='undefined') {
 				callback=function(e){
 					console.log(e);
 				};
 			}
 			if (typeof container=='undefined') {
 				container="chartContainer";
 			}
 			var datapoint=[];
 			for (var i = 0; i < data.name.length; i++) {
 				datapoint.push({
 					y: data.value[i],
 					label: data.name[i],
 					//indexLabel: data.value[i],
 				});
 			}
 			vm.chart = new CanvasJS.Chart(container, {
 				title:{
        			text: title
     			},
		      	axisY:{
			      maximum: 5
			    },
     			axisX:{
   					interval: 1,
   					labelAngle: 90,
 				},
            	data: [
                	{
                		click: callback,
                		type:'column',
                		indexLabelFontColor: "darkSlateGray",
						indexLabelFormatter: formatter,
						indexLabelPlacement: "outside",  
         				indexLabelOrientation: "vertical",
                    	dataPoints: datapoint
                	}
                ]
            });
            vm.chart.render();
            // //
            function formatter(e) {
					return parseFloat(e.dataPoint.y).toFixed(2);
			}
 		}
		
	}
})();