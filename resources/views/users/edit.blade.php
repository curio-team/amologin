@extends('layouts.app')

@push('styles')
	<link rel="stylesheet" href="/chosen/chosen.min.css">
	<link rel="stylesheet" href="/chosen/bootstrap-chosen.css">
@endpush

@push('scripts')
	<script type="text/javascript" src="/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript">
		jQuery("#type").chosen();
		jQuery("#groups").chosen();
	</script>
@endpush

@section('content')

	<div class="container spaced-container">

		<h5>Gebruiker aanpassen</h5>

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<form action="/users/{{ $user->id }}" method="POST">
			@method('PATCH')
			@csrf

			<div class="form-group row">
		    	<div class="col-sm-3">Type</div>
		     	<div class="col-sm-6"><?php echo $user->type == 'teacher' ? 'Docent' : 'Student'; ?></div>
		    </div>
		    <div class="form-group row">
		    	<div class="col-sm-3">D-nummer / afkorting</div>
		     	<div class="col-sm-6">{{ $user->id }}</div>
		    </div>
		    <div class="form-group row">
		    	<div class="col-sm-3">Naam</div>
		     	<div class="col-sm-6">{{ $user->name }}</div>
		    </div>
		    <div class="form-group row">
		    	<div class="col-sm-3">E-mail</div>
		     	<div class="col-sm-6">{{ $user->email }}</div>
		    </div>

		    <fieldset>
		    	<legend>Wachtwoord aanpassen</legend>
		    	<div class="form-group row">
			    	<label for="password" class="col-sm-3 col-form-label">Wachtwoord</label>
			     	<div class="col-sm-6">
			        	<input type="password" class="form-control" id="password" name="password">
			      	</div>
			    </div>
			    <div class="form-group row">
			    	<label for="password_confirmation" class="col-sm-3 col-form-label">Wachtwoord bevestigen</label>
			     	<div class="col-sm-6">
			        	<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
			      	</div>
			    </div>
		    </fieldset>
		    <fieldset>
		    	<legend>Groepen aanpassen</legend>
		    	<div class="form-group row">
			    	<div class="col-sm-3">Overicht van groepen</div>
			     	<div class="col-sm-6">
			     		<table>
			     			@foreach($user_groups as $group)
				     			<tr>
				     				<td>{{ $group->name }}</td>
				     				<td>({{ $group->date_start }} t/m {{ $group->date_end }})</td>
				     			</tr>
			     			@endforeach
			     		</table>
			     	</div>
			     </div>
		    	<div class="form-group row">
			    	<label for="groups" class="col-sm-3 col-form-label">Groepen toevoegen/verwijderen</label>
			     	<div class="col-sm-6">
			        	<select multiple class="form-control form-control-chosen" id="groups" name="groups[]" data-placeholder="Kies groep(en)">
			        		@foreach($groups as $name => $list)
				        		<optgroup label="{{ ucfirst($name) }}">
				        			@foreach($list as $group)
					        			<option value="{{ $group->id }}"
											@if($user_group_ids->contains($group->id)) selected @endif
					        				>
					        				{{ $group->name }}
					        			</option>
					        		@endforeach
				        		</optgroup>
			        		@endforeach
			        	</select>
			      	</div>
			    </div>
		    </fieldset>
		    <fieldset>
		    	<legend>Historische groepen</legend>
		    	<div class="form-group row">
			    	<div class="col-sm-3">Historische groepen</div>
			     	<div class="col-sm-6">
			     		<table>
			     			@foreach($user_groups_history as $group)
				     			<tr>
				     				<td>{{ $group->name }}</td>
				     				<td>({{ $group->date_start }} t/m {{ $group->date_end }})</td>
				     			</tr>
			     			@endforeach
			     		</table>
			     	</div>
			    </div>
		    </fieldset>

		   <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Opslaan</button>
		</form>
	</div>

@endsection
