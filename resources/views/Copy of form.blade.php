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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
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
	    <a class="navbar-brand" href="#">ADAPT</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="#">Home</a>
	        </li>	        
	      </ul>	      
	    </div>
	  </div>
	</nav>
    
    <div class="container">
    	<form method="post" action="{{ route('process-form') }}">
    	@csrf
  		<div class="mb-3">
		  <label for="title" class="form-label">Title</label>
		  <input type="text" class="form-control" id="title" placeholder="" name="title">
		  <div class="form-text">Title of data-publiction</div>
		</div>
		<div class="mb-3">
		  <label for="abstract" class="form-label">Abstract</label>
		  <textarea class="form-control" id="abstract" rows="3" name="abstract"></textarea>
  		  <div class="form-text">Abstract of data-publiction</div>
		</div>
		<div class="mb-3">
		  <label for="additional-technical-documentation" class="form-label">(Additional technical) Documentation</label>
		  <textarea class="form-control" id="additional-technical-documentation" rows="3" name="documentation"></textarea>
  		  <div class="form-text">Abstract of data-publiction</div>
		</div>
		
		<div class="mb-3">						
			<label class="form-label">Disciplines</label>
			<div id="displines-container">
    			<div class="input-group mb-3" id="discipline-group-1">
        			<select class="form-select form-select-mb-3" aria-label=".form-select-lg example" id="select-discipline-1">
        			  <option selected>Select discipline</option>
        			  <option value="1">rock and melt physics</option>
        			  <option value="2">analogue modelling of geologic processes</option>
        			  <option value="3">paleomagnetism</option>
        			  <option value="4">geochemistry</option>
        			  <option value="5">microscopy and tomography</option>
        			</select>
        			<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-discipline-btn">Add discipline</button>		
			<div class="form-text">Add one or more disciplines</div>
		</div>
		
		<script>
    	let discipline_counter = 2;
    	
    	$('#add-discipline-btn').bind("click", function(){    		
    		$('#displines-container').append(
    			'<div class="input-group mb-3" id="discipline-group-' + discipline_counter + '">' +
        			'<select class="form-select form-select-mb-3" aria-label=".form-select-lg example" id="select-discipline-' + discipline_counter + '">' +
        			  '<option selected>Select discipline</option>' +
        			  '<option value="1">rock and melt physics</option>' +
        			  '<option value="2">analogue modelling of geologic processes</option>' +
        			  '<option value="3">paleomagnetism</option>' +
        			  '<option value="4">geochemistry</option>' +
        			  '<option value="5">microscopy and tomography</option>' +
        			'</select>' +
        			'<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>' +
    			'</div>'
    		);
    		
    		discipline_counter = discipline_counter + 1;
    	});    	
    	</script>
    	
    	<div class="mb-3">						
			<label class="form-label">Originating laboratory</label>
			<div id="originating-laboratory-container">
    			<div class="input-group mb-3" id="originating-laboratory-group-1">
        			<select class="form-select form-select-mb-3" aria-label=".form-select-lg example" id="select-originating-laboratory-1">
        			  <option selected>Select originating laboratory</option>
        			  <option value="1">Tectonics Modelling Laboratory (IGG-CNR, Italy)</option>
        			  <option value="2">Rock Mechanics Laboratory (University of Portsmouth, UK)</option>
        			  <option value="3">Rock Deformation Laboratory (GFZ Potsdam, Germany)</option>
        			  <option value="4">Micro-CT laboratory</option>
        			  <option value="5">Andalchron (CSIC-IACT, Spain)</option>
        			</select>
        			<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-originating-laboratory-btn">Add originating laboratory</button>		
			<div class="form-text">Add one or more originating laboratory</div>
		</div>
		
		<script>
    	let originating_laboratory_counter = 2;
    	
    	$('#add-originating-laboratory-btn').bind("click", function(){    		
    		$('#originating-laboratory-container').append(
    			'<div class="input-group mb-3" id="originating-laboratory-group-' + originating_laboratory_counter + '">' +
        			'<select class="form-select form-select-mb-3" aria-label=".form-select-lg example" id="select-originating-laboratory-' + originating_laboratory_counter + '">' +
        			  '<option selected>Select originating laboratory</option>' +
        			  '<option value="1">Tectonics Modelling Laboratory (IGG-CNR, Italy)</option>' +
        			  '<option value="2">Rock Mechanics Laboratory (University of Portsmouth, UK)/option>' +
        			  '<option value="3">Rock Deformation Laboratory (GFZ Potsdam, Germany)</option>' +
        			  '<option value="4">Micro-CT laboratory</option>' +
        			  '<option value="5">Andalchron (CSIC-IACT, Spain)</option>' +
        			'</select>' +
        			'<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>' +
    			'</div>'
    		);
    		
    		originating_laboratory_counter = originating_laboratory_counter + 1;
    	});    	
    	</script>
    	
    	<div class="mb-3">						
			<label class="form-label">Additional laboratory</label>
			<div id="additional-laboratory-container">
    			<div class="input-group mb-3" id="additional-laboratory-group-1">
        			<input type="text" class="form-control">
        			<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-laboratory-btn">Add additional laboratory</button>		
			<div class="form-text">Add one or more additional laboratory</div>
		</div>
		
		<script>
    	let additional_laboratory_counter = 2;
    	
    	$('#add-additional-laboratory-btn').bind("click", function(){    		
    		$('#additional-laboratory-container').append(
    			'<div class="input-group mb-3" id="additional-laboratory-group-' + additional_laboratory_counter + '">' +
        			'<input type="text" class="form-control">' +
        			'<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>' +
    			'</div>'
    		);
    		
    		additional_laboratory_counter = originating_laboratory_counter + 1;
    	});    	
    	</script>
    	
    	<div class="mb-3">
		  <label for="version" class="form-label">Version</label>
		  <input type="text" class="form-control" id="version" placeholder="" name="version">
		  <div class="form-text">Version of data-publiction</div>
		</div>
		
		<div class="mb-3">
			<label for="exampleFormControlTextarea1" class="form-label">Language of the data</label>
			<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">
			  <option selected>Select language</option>
			  <option value="1">English</option>
			  <option value="2">Dutch</option>
			  <option value="3">German</option>
			</select>
			<div id="emailHelp" class="form-text">Select language</div>
		</div>
		
		<div class="row mb-3">
			<p>Collection period</p>
    		  <div class="col">
    		    <label for="exampleFormControlTextarea1" class="form-label">Start date</label>
    		    <input class="form-control" placeholder="YYYY-MM-DD" type="date">
    		  </div>
    		  <div class="col">
    		    <label for="exampleFormControlTextarea1" class="form-label">End date</label>
    		    <input class="form-control" placeholder="" type="date">
    		  </div>
    		  <div class="form-text"></div>
		</div>
		
				
		<div class="mb-3">
			<label>Geo location(s)</label>
            <ul class="list-group" id="locations-list-group" style="margin-top: 5px; margin-bottom: 5px;"></ul>
            <button type="button" class="btn btn-light btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#map">Select location(s)</button>              		  		  
		</div>
		
		<div class="mb-3">
		  <label>Keywords</label>
		  <ul class="list-group" id="form-list-group" style="margin-top: 5px; margin-bottom: 5px;"></ul>		  
		  <button type="button" class="btn btn-light btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#keywordsModal">Select keywords</button>
		</div>
		
		<div class="mb-3">						
			<label class="form-label">Related datapackages</label>
			<div id="related-datapackages-container">
				<div class="card" id="related-datapackages-card-1">
					<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>
					<div class="card-body">						
        				<label for="related-work" class="form-label">Related work</label>
		  				<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">
            			  <option selected>Select relation</option>
            			  <option value="1">IsCitedBy</option>
            			  <option value="2">Cites</option>
            			  <option value="3">IsSupplementTo</option>
            			</select>
		  				<div class="form-text">Relation to this data package</div>
		  				
		  				<label for="related-work-title" class="form-label">Title</label>
		  				<input type="text" class="form-control" id="related-work-title" placeholder="" name="related-work-title">
		  				<div class="form-text">Title of the related work</div>
		  				
		  				<div class="row">
							<p>Persistent identifier</p>
    		  				<div class="col">
    		    				<label for="exampleFormControlTextarea1" class="form-label">Type</label>
    		    				<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">
                    			  <option selected>Select type</option>
                    			  <option value="1">DOI</option>
                    			  <option value="2">EAN13</option>
                    			  <option value="3">Handle</option>
                    			</select>
    		  				</div>
    		  				<div class="col">
    		    				<label for="exampleFormControlTextarea1" class="form-label">Identifier</label>
    		    				<input class="form-control" placeholder="" type="text">
    		  				</div>
    		  				<div class="form-text"></div>
						</div>		  				
        			</div>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-related-datapackage-btn" style="margin-top: 10px;">Add additional related work</button>		
			<div class="form-text">Add one or more related datapackages</div>
		</div>
		
		<script>
    	let related_datapackage_counter = 2;
    	
    	$('#add-additional-related-datapackage-btn').bind("click", function(){    		
    		$('#related-datapackages-container').append(
    			'<div class="card" id="related-datapackages-card-' + related_datapackage_counter + '">' +
					'<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>' +
					'<div class="card-body">' +						
        				'<label for="related-work" class="form-label">Related work</label>' +
		  				'<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">' +
            			  '<option selected>Select relation</option>' +
            			  '<option value="1">IsCitedBy</option>' +
            			  '<option value="2">Cites</option>' +
            			  '<option value="3">IsSupplementTo</option>' +
            			'</select>' +
		  				'<div class="form-text">Relation to this data package</div>' +		  				
		  				'<label for="related-work-title" class="form-label">Title</label>' +
		  				'<input type="text" class="form-control" id="related-work-title" placeholder="" name="related-work-title">' +
		  				'<div class="form-text">Title of the related work</div>' +		  				
		  				'<div class="row">' +
							'<p>Persistent identifier</p>' +
    		  				'<div class="col">' +
    		    				'<label for="exampleFormControlTextarea1" class="form-label">Type</label>' +
    		    				'<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">' +
                    			  '<option selected>Select type</option>' +
                    			  '<option value="1">DOI</option>' +
                    			  '<option value="2">EAN13</option>' +
                    			  '<option value="3">Handle</option>' +
                    			'</select>' +
    		  				'</div>' +
    		  				'<div class="col">' +
    		    				'<label for="exampleFormControlTextarea1" class="form-label">Identifier</label>' +
    		    				'<input class="form-control" placeholder="" type="text">' +
    		  				'</div>' +
    		  				'<div class="form-text"></div>' +
						'</div>' +		  				
        			'</div>' +
    			'</div>'
    		);
    		
    		related_datapackage_counter = related_datapackage_counter + 1;
    	});    	
    	</script>
    	
    	
    	<div class="mb-3">						
			<label class="form-label">Funding references</label>
			<div id="funding-references-container">
				<div class="card" id="funding-references-card-1">
					<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>
					<div class="card-body">						
        				<label for="funding-reference" class="form-label">Funding reference</label>
		  				<input type="text" class="form-control" id="funding-reference" placeholder="" name="funding-reference">
		  				
		  				<label for="funder-reference-name" class="form-label">Funder name</label>
		  				<input type="text" class="form-control" id="funder-reference-name" placeholder="" name="funder-reference-name">
		  				<div class="form-text">The name(s) of the organisation(s) funding the research.</div>
		  				
		  				<label for="funder-reference-grant-number" class="form-label">Grant number</label>
		  				<input type="text" class="form-control" id="funder-reference-grant-number" placeholder="" name="funder-reference-grant-number">
		  				<div class="form-text">The award or grant number issued by the funding organisation.</div>
		  				
		  				<label for="funder-reference-grant-name" class="form-label">Grant name</label>
		  				<input type="text" class="form-control" id="funder-reference-grant-name" placeholder="" name="funder-reference-grant-name">		  												  				
        			</div>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-funding-reference-btn" style="margin-top: 10px;">Add funding reference</button>		
			<div class="form-text">Add one or more funding references</div>
		</div>
		
		<script>
    	let funding_reference_counter = 2;
    	
    	$('#add-additional-funding-reference-btn').bind("click", function(){    		
    		$('#funding-references-container').append(
    			'<div class="card" id="funding-references-card-' + funding_reference_counter + '">' +
					'<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>' +
					'<div class="card-body">' +						
        				'<label for="funding-reference" class="form-label">Funding reference</label>' +
		  				'<input type="text" class="form-control" id="funding-reference" placeholder="" name="funding-reference">' +		  				
		  				'<label for="funder-reference-name" class="form-label">Funder name</label>' +
		  				'<input type="text" class="form-control" id="funder-reference-name" placeholder="" name="funder-reference-name">' +
		  				'<div class="form-text">The name(s) of the organisation(s) funding the research.</div>' +		  			
		  				'<label for="funder-reference-grant-number" class="form-label">Grant number</label>' +
		  				'<input type="text" class="form-control" id="funder-reference-grant-number" placeholder="" name="funder-reference-grant-number">' +
		  				'<div class="form-text">The award or grant number issued by the funding organisation.</div>' +		  				
		  				'<label for="funder-reference-grant-name" class="form-label">Grant name</label>' +
		  				'<input type="text" class="form-control" id="funder-reference-grant-name" placeholder="" name="funder-reference-grant-name">' +
						'</div>' +		  				
        			'</div>' +
    			'</div>'
    		);
    		
    		funding_reference_counter = funding_reference_counter + 1;
    	});    	
    	</script>
		
		<div class="mb-3">						
			<label class="form-label">Creators</label>
			<div id="creators-container">
				<div class="card" id="creators-card-1">
					<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>
					<div class="card-body">						
        				<div class="row">
							<p>Creator of datapackage</p>
    		  				<div class="col">
    		    				<label for="exampleFormControlTextarea1" class="form-label">First name</label>
    		    				<input class="form-control" placeholder="" type="text">
    		  				</div>
    		  				<div class="col">
    		    				<label for="exampleFormControlTextarea1" class="form-label">Family name</label>
    		    				<input class="form-control" placeholder="" type="text">
    		  				</div>
    		  				<div class="form-text"></div>
		  				</div>    		  				
		  				<label class="form-label">Affiliation</label>
            			<div id="additional-affiliation-container">
                			<div class="input-group mb-3" id="additional-laboratory-group-1">
                    			<input type="text" class="form-control">
                    			<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>
                			</div>
            			</div>
            			
            			<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-affiliation-btn">Add additional affiliation</button>		
            			<div class="form-text">Add one or more affiliations</div>
            			
            			<script>
            				let affiliation_counter = 2;
            				
            				$('#add-additional-affiliation-btn').bind("click", function(){    		
                        		$('#additional-affiliation-container').append(
                        			'<div class="input-group mb-3" id="additional-laboratory-group-' + affiliation_counter + '">' +
                        			'<input type="text" class="form-control">' +
                        			'<button type="button" class="btn btn-light btn-outline-secondary" onclick="$(this).parent().remove();"> <i class="bi bi-trash"></i></button>' +
                    				'</div>'
                        		);
                    		
                    			affiliation_counter = affiliation_counter + 1;
                    		});
            			</script>
            			
            			<div id="creator-identifiers-container">
            				<div class="card" id="creator-identifiers-card-1">
            					<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>
            					<div class="card-body">
            						<p>Persistent identifier</p>							
                        			<div class="row">            				    							
                		  				<div class="col">
                		    				<label for="exampleFormControlTextarea1" class="form-label">Type</label>
                		    				<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">
                                			  <option selected>Select type</option>
                                			  <option value="1">ORCID</option>
                                			  <option value="2">DAI</option>
                                			  <option value="3">Scopus</option>
                                			</select>
                		  				</div>
                		  				<div class="col">
                		    				<label for="exampleFormControlTextarea1" class="form-label">Identifier</label>
                		    				<input class="form-control" placeholder="" type="text">
                		  				</div>                		  				                		  				                    				
                					</div>                					
                				</div>                				
            				</div>
        				</div>
        				<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-creator-identifier-btn" style="margin-top: 10px;">Add identifier</button>
    					<div class="form-text">Add one or more identifiers</div>                					                					
        				<script>
    						let creator_identifier_counter = 2;
				
            				$('#add-additional-creator-identifier-btn').bind("click", function(){    		
                        		$('#creator-identifiers-container').append(
                        			'<div class="card" id="creator-identifiers-card-' + creator_identifier_counter + '">' +
                    					'<div class=card-header"><button type="button" class="btn btn-light " style="float: right;" onclick="$(this).parent().parent().remove();"><i class="bi bi-trash"></i></button></div>' +
                    					'<div class="card-body">' +
                    						'<p>Persistent identifier</p>' +							
                                			'<div class="row">' +            				    							
                        		  				'<div class="col">' +
                        		    				'<label for="exampleFormControlTextarea1" class="form-label">Type</label>' +
                        		    				'<select class="form-select form-select-mb-3" aria-label=".form-select-lg example">' +
                                        			  '<option selected>Select type</option>' +
                                        			  '<option value="1">ORCID</option>' +
                                        			  '<option value="2">DAI</option>' +
                                        			  '<option value="3">Scopus</option>' +
                                        			'</select>' +
                        		  				'</div>' +
                        		  				'<div class="col">' +
                        		    				'<label for="exampleFormControlTextarea1" class="form-label">Identifier</label>' +
                        		    				'<input class="form-control" placeholder="" type="text">' +
                        		  				'</div>' +                		  				                		  				                    				
                        					'</div>' +                					
                        				'</div>' +                				
                    				'</div>'
                        		);
                    		
                    			creator_identifier_counter = creator_identifier_counter + 1;
                    		});                					
    					</script>
        			</div>
    			</div>
			</div>
			
			<button type="button" class="btn btn-light btn-outline-secondary" id="add-additional-creator-btn" style="margin-top: 10px;">Add creator</button>		
			<div class="form-text">Add one or more creators</div>
			
			<script>
				let creator_counter = 2;
				
				$('#add-additional-creator-btn').bind("click", function() {
					$('#creators-card-1').clone().prop("id", "creators-card-" + creator_counter).appendTo('#creators-container');
				});
				
				creator_counter = creator_counter + 1;
			</script>
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
                            	<button class="btn btn-outline-secondary" type="button" id="button-add-custom-keyword">Add</button>
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
    	function addMarkerToForm(geoJson, layerid) {
    		$("#locations-list-group").append(
    			'<li class="list-group-item" id="location-item-' + layerid + '">type: point<br>' +
    			'lat: ' + geoJson.geometry.coordinates[1] + ' lng: ' + geoJson.geometry.coordinates[0] + '</li>'    			
    		);
    	}
    	
    	function addBoxToForm(geoJson, layerid) {
    		$("#locations-list-group").append(
    			'<li class="list-group-item" id="location-item-' + layerid + '">type: box<br>' +
    			'polygon: (' + geoJson.geometry.coordinates[0] + ')</li>'    			
    		);
    	}
    	
    	function clearForm() {
    		//$("#geolocation-container").empty();
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
          
          editableLayers.addLayer(layer);
          
          if(type == 'marker') {
          	addMarkerToForm(layer.toGeoJSON(), layer._leaflet_id);
          } else if (type == 'rectangle') {
          	addBoxToForm(layer.toGeoJSON(), layer._leaflet_id);
          }
                                	  
        });
		
		$('#map').on('shown.bs.modal', function(event) {
			map.invalidateSize(true);
		});
		
		map.on(L.Draw.Event.DELETED, function(e) {  
			layers = e.layers._layers;
			for (var i in layers) {
				$("#location-item-" + i).remove();
			}  
        });    
    </script>
  </body>
</html>