<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adapt form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/treejs.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js" integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style type="text/css">
        .jstree-container-ul>li>a>i.jstree-checkbox
        {
            display:none
        }
        
        #leaflet { height: 600px; }
        
        
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="{{ route('index') }}">ADAPT</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
	        </li>	        
	      </ul>	      
	    </div>
	  </div>
	</nav>
    
    <div class="container">
    	<form method="post" action="{{ route('process-form') }}">
    	@csrf
  		<div class="mb-3">
		  <label for="exampleFormControlInput1" class="form-label">Title</label>
		  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="title" name="title">
		  <div id="emailHelp" class="form-text">Title of data-publiction</div>
		</div>
		<div class="mb-3">
		  <label for="exampleFormControlTextarea1" class="form-label">Abstract</label>
		  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="abstract"></textarea>
  		  <div id="emailHelp" class="form-text">Abstract of data-publiction</div>
		</div>
		<div class="mb-3">
		  <label for="exampleFormControlTextarea1" class="form-label">(Additional technical) Documentation</label>
		  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="documentation"></textarea>
  		  <div id="emailHelp" class="form-text">Abstract of data-publiction</div>
		</div>
		
		<div class="mb-3">
			<label for="exampleFormControlTextarea1" class="form-label">Disciplines</label>
			<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">
			  <option selected>Select disciplines</option>
			  <option value="1">rock and melt physics</option>
			  <option value="2">analogue modelling of geologic processes</option>
			  <option value="3">paleomagnetism</option>
			  <option value="4">geochemistry</option>
			  <option value="5">microscopy and tomography</option>
			</select>
			<div id="emailHelp" class="form-text">Select one or more disciplines</div>
		</div>
		
		<div class="row">
			<p>collection period</p>
		  <div class="col">
		    <label for="exampleFormControlTextarea1" class="form-label">Start date</label>
		    <input class="form-control" placeholder="" type="date">
		  </div>
		  <div class="col">
		    <label for="exampleFormControlTextarea1" class="form-label">End date</label>
		    <input class="form-control" placeholder="" type="date">
		  </div>
		</div>
		
		
		
		<div class="mb-3">
		  <label>Keywords</label>
		  <ul class="list-group" id="form-list-group">
		  	
		  </ul>
		  
		  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#keywordsModal">
			  Select keywords
		  </button>
		</div>
		
		<!-- Keyword Modal -->
		<div class="modal modal-xl fade" id="keywordsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="keywordsModalLabel">Keywords</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">
		      		<div class="row">
		      			<div class="col-md-12">
		      				<input id="search-input" class="form-control" placeholder="Search..." />
		      			</div>
		      		</div>
		      		<hr>
		      		<div class="row">
		      			<div class="col-md-6">
		      				<div id="tree"></div>
	      				</div>
	      				<div class="col-md-6">
	      					<ul class="list-group" id="modal-list-group">
                            </ul>
	      				</div>
		      		</div>
		      		<hr>
		      		<div class="row">
			        	<div class="col-md-12">
			        		<div class="input-group">
                            	<input type="text" class="form-control" placeholder="Custom keyword" id="add-custom-keyword" >
                            	<button class="btn btn-outline-primary" type="button" id="button-add-custom-keyword">Add</button>
                            </div>			        			
	      				</div>
		        	</div>		      			        		        
		        </div>		        		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		
		
		<div class="mb-3">
			<div class="card">
          <h5 class="card-header">Geo location</h5>
              <div class="card-body">
                <div id="geolocation-container"></div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#map">
			  		Select location
		  		</button>
              </div>
            </div>
		  		  
		</div>
		
		<!-- Map modal -->
		<div class="modal modal-xl fade" id="map" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="keywordsModalLabel">Geo location</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<div id="leaflet"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
				
		
		<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="./jstree.js"></script>
    <script>
    	let counter = 1;
        	
    	$('#button-add-custom-keyword').bind("click", function(){    		
    		if($('#add-custom-keyword').val().length > 2) {
    			addFreeTextElements($('#add-custom-keyword').val());
    			$('#add-custom-keyword').val('');
    		}
    	});
    	
    	function addFreeTextElements(text) {
    		var now = Date.now();
    	
    		$("#modal-list-group").append(
    			'<li class="list-group-item" id="modal-list-group-item-' + now +'"><i class="bi bi-pen"> ' + text + '<a href="#" id="modal-list-group-item-delete-' + now + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a>' +
    			'<input type="hidden" name="keywords[' + counter + '][text]" value="' + text +'">' +
    			'<input type="hidden" name="keywords[' + counter + '][uri]" value="">' +  
    			'<input type="hidden" name="keywords[' + counter + '][vocab-uri]" value=""></li>'
    		);
    		
    		$('#modal-list-group-item-delete-' + now).bind("click", function() {
  				$('#modal-list-group-item-' + now).remove();
  				$('#form-list-group-item-' + now).remove();
			});
			
			$("#form-list-group").append(
    			'<li class="list-group-item" id="form-list-group-item-' + now +'"><i class="bi bi-pen"> ' + text + '<a href="#" id="form-list-group-item-delete-' + now + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a></li>'
    		);
    		
    		$('#form-list-group-item-delete-' + now).bind("click", function(){
  				$('#form-list-group-item-' + now).remove();
  				$('#modal-list-group-item-' + now).remove();
			});
			
			counter = counter + 1;
    	}
    
    	function addModalElement(node) {
    		$("#modal-list-group").append(
    			'<li class="list-group-item" id="modal-list-group-item-' + node.id +'"><i class="bi bi-book"> ' + node.text + '<a href="#" id="modal-list-group-item-delete-' + node.id + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a></li>'
    		);
    		
    		$('#modal-list-group-item-delete-' + node.id).bind("click", function(){
  				$('#modal-list-group-item-' + node.id).remove();
  				$("#tree").jstree("uncheck_node", node.id);
			});
    	}
    	
    	function addFormElement(node) {
    		$("#form-list-group").append(
    			'<li class="list-group-item" id="form-list-group-item-' + node.id +'"><i class="bi bi-book"> ' + node.text + '<a href="#" id="form-list-group-item-delete-' + node.id + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a>' +
    			'<input type="hidden" name="keywords[' + counter + '][text]" value="' + node.text +'">' +
    			'<input type="hidden" name="keywords[' + counter + '][uri]" value="' + node.original.extra.uri +'">' +  
    			'<input type="hidden" name="keywords[' + counter + '][vocab-uri]" value="' + node.original.extra.vocab_uri + '"></li>'
    		);    		
    		
    		$('#form-list-group-item-delete-' + node.id).bind("click", function(){
  				$('#form-list-group-item-' + node.id).remove();
  				$("#tree").jstree("uncheck_node", node.id);
			});
			
			counter = counter + 1;
    	}    	
    
		request = $.getJSON("tree.json");
		var data;
		request.complete(function() {
			data = JSON.parse(request.responseText);
			$.jstree.defaults.core.themes.responsive = true;
			$('#tree').jstree({
				plugins: ["checkbox", "wholerow", "search"],
				"types": {
					"file": {
						"icon": "jstree-file"
	      			}
		    	},
		    	'core': {
					'data': data
		    	},
				checkbox: {
					three_state : false, // to avoid that fact that checking a node also check others
					whole_node : false,  // to avoid checking the box just clicking the node
					tie_selection : false // for checking without selecting and selecting without checking
          		},
          		"search": {
					"case_sensitive": false,
					"show_only_matches": true
            	}
		  	})
		  	.on("check_node.jstree uncheck_node.jstree", function(e, data) {
		  		if(e.type == "check_node") {
		  			addModalElement(data.node);
		  			addFormElement(data.node);
		  		} else if (e.type == "uncheck_node") {
		  			$('#modal-list-group-item-' + data.node.id).remove();
		  			$('#form-list-group-item-' + data.node.id).remove();
		  		}		  	
		  	});		  		  
		});
		
		$(document).ready(function () {
            $("#search-input").keyup(function () {
                var searchString = $(this).val();
                $('#tree').jstree('search', searchString);
            });
        });
    </script>
    <script>
    	function addMarkerToForm(geoJson) {
    		$("#geolocation-container").append(
    			'<p>type: point<br>' +
    			'lat: ' + geoJson.geometry.coordinates[1] + ' lng: ' + geoJson.geometry.coordinates[0] + '</p>'
    			
    		);
    	}
    	
    	function addBoxToForm(geoJson) {
    		$("#geolocation-container").append(
    			'<p>type: box<br>' +
    			'polygon: (' + geoJson.geometry.coordinates[0] + ')</p>'    			
    		);
    	}
    	
    	function clearForm() {
    		$("#geolocation-container").empty();
    	}
    
		var map = L.map('leaflet').setView([54.505, 15.09], 5);
		
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    		maxZoom: 19,
    		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
		
		// Initialise the FeatureGroup to store editable layers
		var editableLayers = new L.FeatureGroup();
		map.addLayer(editableLayers);
		
		var drawPluginOptions = {
          position: 'topright',
          draw: {
            polyline: false,
            polygon: false, 
            circle: false,
            circlemarker: false, 
            rectangle: {
              shapeOptions: {
                clickable: false
              }
            },
            marker: {}
          },
          edit: {
            featureGroup: editableLayers, 
          }
        };
        
        var drawPluginOptionsDisabled = {
          position: 'topright',
          draw: false,
          edit: {
            featureGroup: editableLayers, 
          }
        };
        
        
        // Initialise the draw control and pass it the FeatureGroup of editable layers
        var drawControlFull = new L.Control.Draw(drawPluginOptions);
        var drawControlEditOnly = new L.Control.Draw(drawPluginOptionsDisabled);
        map.addControl(drawControlFull);
        
        map.on('draw:created', function(e) {
          var type = e.layerType,
          layer = e.layer;
          
          if(type == 'marker') {
          	addMarkerToForm(layer.toGeoJSON());
          } else if (type == 'rectangle') {
          	addBoxToForm(layer.toGeoJSON());
          }
        
          editableLayers.addLayer(layer);
          drawControlFull.remove(map);
    	  drawControlEditOnly.addTo(map);
    	  
    	  console.log(e._leaflet_id);
    	  console.log(layer._leaflet_id);
        });
		
		$('#map').on('shown.bs.modal', function(event) {
			map.invalidateSize(true);
		});
		
		map.on(L.Draw.Event.DELETED, function(e) {
           if (editableLayers.getLayers().length === 0){
                drawControlEditOnly.remove(map);
                drawControlFull.addTo(map);
            };
			clearForm();            
        });    
    </script>
  </body>
</html>