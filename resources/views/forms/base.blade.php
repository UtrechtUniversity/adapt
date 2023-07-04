<form method="post" action="{{ route('process-keywords-form-excel') }}">
@csrf
<h1>{{ $form->name }}</h1>
<p>{{ $form->description }}</p>

@foreach ($form->getFields() as $field)
	@include($field->getTemplate(), ['field' => $field])
@endforeach

<button type="submit" class="btn btn-primary">Submit</button>
</form>