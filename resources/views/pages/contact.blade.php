@extends('layouts.master')

@section('content')
	<h1>Get in Touch</h1>
	<hr>

	<div class="row">
		<div class="col-md-10">
			<form method="POST" action="/contact">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
					{!! $errors->first('name', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
					{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
					<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}">
					{!! $errors->first('mobile', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
					<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}">
					{!! $errors->first('subject', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
					<textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message...">{{ old('message') }}</textarea>
					{!! $errors->first('message', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Send Message</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>	
			</form>
		</div>

		<div class="col-md-2">
			&nbsp;
		</div>
	</div>
@endsection