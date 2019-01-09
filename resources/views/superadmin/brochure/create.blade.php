@extends('layouts.master')
@push('page-style')
<style media="screen">
	.bootstrap-tagsinput{
		width:100%;
	}
</style>
@endpush
@section('page-content')
<div class="title-bar">
	<h1 class="title-bar-title">
		<span class="d-ib">Add New Brochure</span>
	</h1>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="demo-form-wrapper">
			<form class="form form-horizontal" method="post" action="{{ route('brochure.store')}}" enctype="multipart/form-data">
				 {{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label" for="title">Brochure Title</label>
					<div class="col-sm-9">
						<input name="title" id="title" class="form-control" type="text" required value="{{old('title')}}">
						@if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    </span>
                       @endif
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-3 control-label" for="title">Brochure Description</label>
					<div class="col-sm-9">
						<textarea name="description" id="description" class="form-control" required>{{old('Description')}}</textarea>
						@if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                    </span>
                       @endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="file">Upload File</label>
					<div class="col-sm-9">
						<input name="file" id="file" class="form-control" type="file" value="">
						@if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('file') }}</strong>
                                    </span>
                        @endif
					</div>
				</div>
				<div class="col-sm-offset-3 col-sm-9">
					<button class="btn btn-outline-primary">
						<i class="icon icon-paper-plane"></i> Submit Details
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
