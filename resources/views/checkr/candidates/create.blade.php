{{ Form::model(App\CheckrCandidate::class, ['route' => ['candidates.store']]) }}

<div class="form-group">
    {{ Form::label('email', 'Email Address', ['class' => 'control-label']) }}
    {{ Form::text('email', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('first_name', 'First Name', ['class' => 'control-label']) }}
    {{ Form::text('first_name', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('middle_name', 'Middle Name', ['class' => 'control-label']) }}
    {{ Form::text('middle_name', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('last_name', 'Last Name', ['class' => 'control-label']) }}
    {{ Form::text('last_name', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('dob', 'Date of Birth', ['class' => 'control-label']) }}
    {{ Form::text('dob', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('ssn', 'Social Security Number', ['class' => 'control-label']) }}
    {{ Form::text('ssn', null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('zipcode', 'Zip Code', ['class' => 'control-label']) }}
    {{ Form::text('zipcode', null, array_merge(['class' => 'form-control'])) }}
</div>

{{ Form::submit('Submit') }}
{{ Form::close() }}