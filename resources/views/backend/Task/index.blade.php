@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

<!-- Summernote CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">
@endsection

@section('page-header')
<div class="row align-items-center">
	<div class="col">
		<h3 class="page-title">Task</h3>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
			<li class="breadcrumb-item active">Task</li>
		</ul>
	</div>
	<div class="col-auto float-right ml-auto">
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i> Add Task</a>
		<div class="view-icons">
			<a href="{{route('task')}}" class="grid-view btn btn-link {{route_is('task') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('task-list')}}" class="list-view btn btn-link {{route_is('task-list') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection


@section('content')

<div class="row staff-grid-row">
	@if (!empty($tasks->count()))
		@foreach ($tasks as $task)
			<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
				<div class="profile-widget">
					<div class="profile-img">
						<a href="javascript:void(0)" class="avatar"><img alt="" src="@if(!empty($client->avatar)) {{asset('storage/tasks/'.$task->image)}} @else assets/img/profiles/default.jpg @endif"></a>
					</div>
					<div class="dropdown profile-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a data-id="{{$task->id}}" data-firstname="{{$task->firstname}}" data-lastname="{{$task->lastname}}" data-email="{{$task->email}}" data-phone="{{$task->phone}}" data-image="{{$task->image}}" data-company="{{$task->company}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						<a data-id="{{$task->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
					</div>
					</div>
					<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$task->company}}</a></h4>
					<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$task->firstname}} {{$task->lastname}}</a></h5>
					
				</div>
			</div>
		@endforeach
		<x-modals.delete :route="'task.destroy'" :title="'Task'" />

		<!-- Edit Client Modal -->
		<div id="edit_task" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" enctype="multipart/form-data" action="{{route('task.update')}}">
							@csrf
							@method("PUT")
							<div class="row">
								<input type="hidden" id="edit_id" name="id">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">First Name <span class="text-danger">*</span></label>
										<input class="form-control edit_firstname" name="firstname" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Last Name</label>
										<input class="form-control edit_lastname" name="lastname" type="text">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input class="form-control floating edit_email" name="email" type="email">
									</div>
								</div>
								
								<div class="col-md-6">  
									<div class="form-group">
										<label class="col-form-label">Client Picture<span class="text-danger">*</span></label>
										<input class="form-control floating edit_image" name="image" type="file">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Phone </label>
										<input class="form-control edit_phone" name="phone" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-form-label">Company Name</label>
										<input class="form-control edit_company" name="company" type="text">
									</div>
								</div>
							</div>
							
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Client Modal -->
	@endif
	
</div>

<!-- Add Client Modal -->
<div id="add_task" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Task</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data" action="{{route('task.add')}}">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">First Name <span class="text-danger">*</span></label>
								<input class="form-control" name="firstname" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Last Name</label>
								<input class="form-control" name="lastname" type="text">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Email <span class="text-danger">*</span></label>
								<input class="form-control floating" name="email" type="email">
							</div>
						</div>
						
						<div class="col-md-6">  
							<div class="form-group">
								<label class="col-form-label">Client Picture<span class="text-danger">*</span></label>
								<input class="form-control floating" name="image" type="file">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Phone </label>
								<input class="form-control" name="phone" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Company Name</label>
								<input class="form-control" name="company" type="text">
							</div>
						</div>
					</div>
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_task').modal('show');
			var id = $(this).data('id');
			var firstname = $(this).data('firstname');
			var lastname = $(this).data('lastname');
			var email = $(this).data('email');
			var phone = $(this).data('phone');
			var image = $(this).data('image');
			var company = $(this).data('company');

			$('#edit_id').val(id);
			$('.edit_firstname').val(firstname);
			$('.edit_lastname').val(lastname);
			$('.edit_email').val(email);
			$('.edit_phone').val(phone);
			$('.edit_company').val(company);
			$('.edit_image').val(image);
		})
	})
</script>
@endsection
