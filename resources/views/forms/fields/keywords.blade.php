<div class="mb-3">
  <label>{{ $field->label }}</label>
  <ul class="list-group" id="{{ $field->name }}-form-list-group" style="margin-top: 5px; margin-bottom: 5px;"></ul>		  
  <button type="button" class="btn btn-light btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#{{ $field->name }}-keywords-modal">Select keywords</button>
</div>

<!-- Keyword Modal -->
<div class="modal modal-xl fade" id="{{ $field->name }}-keywords-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      				<div class="input-group">
      					<input id="search-input" class="form-control" placeholder="Search..." />
      					<button class="btn btn-outline-secondary" type="button" id="button-add-custom-keyword">Add</button>
      				</div>
      			</div>
      		</div>
      		<hr>
      		<div class="row">
      			<div class="col-md-6">
      				<div id="{{ $field->name }}-tree"></div>
  				</div>
  				<div class="col-md-6">
  					<ul class="list-group" id="{{ $field->name }}-modal-list-group">
                    </ul>
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

@push('scripts')
<script src="./jstree.js"></script>
<script>
	let counter = 1;
    	
	$('#button-add-custom-keyword').bind("click", function(){    		
		if($('#search-input').val().length > 2) {
			if(confirm('Are you sure the keyword you want to assign does not exist in the vocabularies? Findablity is greatly improved using shared terminology.')) {
				addFreeTextElements($('#search-input').val());
				$('#search-input').val('');
			}
		}
	});
	
	function addFreeTextElements(text) {
		var now = Date.now();
	
		$("#{{ $field->name }}-modal-list-group").append(
			'<li class="list-group-item" id="{{ $field->name }}-modal-list-group-item-' + now +'"><i class="bi bi-pen"> ' + text + '<a href="#" id="{{ $field->name }}-modal-list-group-item-delete-' + now + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a>' +
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][text]" value="' + text +'">' +
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][uri]" value="">' +  
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][vocab-uri]" value=""></li>'
		);
		
		$('#{{ $field->name }}-modal-list-group-item-delete-' + now).bind("click", function() {
			$('#{{ $field->name }}-modal-list-group-item-' + now).remove();
			$('#{{ $field->name }}-form-list-group-item-' + now).remove();
		});
		
		$("#{{ $field->name }}-form-list-group").append(
			'<li class="list-group-item" id="{{ $field->name }}-form-list-group-item-' + now +'"><i class="bi bi-pen"> ' + text + '<a href="#" id="{{ $field->name }}-form-list-group-item-delete-' + now + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a></li>'
		);
		
		$('#{{ $field->name }}-form-list-group-item-delete-' + now).bind("click", function(){
			$('#{{ $field->name }}-form-list-group-item-' + now).remove();
			$('#{{ $field->name }}-modal-list-group-item-' + now).remove();
		});
		
		counter = counter + 1;
	}

	function addModalElement(node) {
		$("#{{ $field->name }}-modal-list-group").append(
			'<li class="list-group-item" id="{{ $field->name }}-modal-list-group-item-' + node.id +'"><i class="bi bi-book"> ' + node.text + '<a href="#" id="{{ $field->name }}-modal-list-group-item-delete-' + node.id + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a></li>'
		);
		
		$('#{{ $field->name }}-modal-list-group-item-delete-' + node.id).bind("click", function(){
			$('#{{ $field->name }}-modal-list-group-item-' + node.id).remove();
			$("#{{ $field->name }}-tree").jstree("uncheck_node", node.id);
		});
	}
	
	function addFormElement(node) {
		$("#{{ $field->name }}-form-list-group").append(
			'<li class="list-group-item" id="{{ $field->name }}-form-list-group-item-' + node.id +'"><i class="bi bi-book"> ' + node.text + '<a href="#" id="{{ $field->name }}-form-list-group-item-delete-' + node.id + '" title="remove keyword"><i class="bi bi-x text-danger"></i></a>' +
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][text]" value="' + node.text +'">' +
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][uri]" value="' + node.original.extra.uri +'">' +  
			'<input type="hidden" name="{{ $field->name }}[' + counter + '][vocab-uri]" value="' + node.original.extra.vocab_uri + '"></li>'
		);    		
		
		$('#{{ $field->name }}-form-list-group-item-delete-' + node.id).bind("click", function(){
			$('#{{ $field->name }}-form-list-group-item-' + node.id).remove();
			$("#{{ $field->name }}-tree").jstree("uncheck_node", node.id);
		});
		
		counter = counter + 1;
	}    	

	request = $.getJSON("{{ $field->vocabularyLocation }}");
	var data;
	request.complete(function() {
		data = JSON.parse(request.responseText);
		$.jstree.defaults.core.themes.responsive = true;
		$('#{{ $field->name }}-tree').jstree({
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
	  			$('#{{ $field->name }}-modal-list-group-item-' + data.node.id).remove();
	  			$('#{{ $field->name }}-form-list-group-item-' + data.node.id).remove();
	  		}		  	
	  	});		  		  
	});
	
	$(document).ready(function () {
        $("#search-input").keyup(function () {
            var searchString = $(this).val();
            $('#{{ $field->name }}-tree').jstree('search', searchString);
        });
    });
</script>
@endpush