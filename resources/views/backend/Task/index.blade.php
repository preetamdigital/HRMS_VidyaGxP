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
			var taskname = $(this).data('taskname');
			var taskdescription = $(this).data('taskdescription');
			var taskdeadline = $(this).data('taskdeadline');
			var priority = $(this).data('priority');
			var company = $(this).data('company');
			var image = $(this).data('image');

			$('#edit_id').val(id);
			$('.edit_taskname').val(taskname);
			$('.edit_taskdescription').val(taskdescription);
			$('.edit_taskdeadline').val(taskdeadline);
			$('.edit_taskpriority').val(taskpriority);
			$('.edit_company').val(company);
			$('.edit_image').val(image);
		})
	})
</script>
@endsection
