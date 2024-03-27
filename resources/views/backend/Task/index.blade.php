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
			<a href="{{route('tasks-show')}}" class="list-view btn btn-link {{route_is('tasks-show') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection


@section('content')




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
				<!-- <form method="POST" enctype="multipart/form-data" action="#">
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
				</form> -->




				<form method="POST" action="#">
    @csrf <!-- CSRF Protection -->
    
    <!-- Task Name -->
    <div class="form-group">
        <label for="task_name">Task Name:</label>
        <input type="text" name="task_name" id="task_name" class="form-control" placeholder="Enter task name" required>
    </div>
    
    <!-- Task Description -->
    <div class="form-group">
        <label for="task_description">Task Description:</label>
        <textarea name="task_description" id="task_description" class="form-control" rows="3" placeholder="Enter task description"></textarea>
    </div>
    
    <!-- Task Deadline -->
    <div class="form-group">
        <label for="task_deadline">Task Deadline:</label>
        <input type="date" name="task_deadline" id="task_deadline" class="form-control" required>
    </div>
    
    <!-- Task Priority -->
    <div class="form-group">
        <label for="task_priority">Task Priority:</label>
        <select name="task_priority" id="task_priority" class="form-control" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>
    
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
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
