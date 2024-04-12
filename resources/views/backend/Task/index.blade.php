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
			<a href="{{ route('tasks') }}" class="grid-view btn btn-link {{ route_is('tasks') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('tasks-show')}}" class="list-view btn btn-link {{ route_is('tasks-show') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
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
						<a href="javascript:void(0)" class="avatar"><img alt="" src="@if(!empty($task->image)) {{asset('storage/tasks/'.$task->image)}} @else assets/img/profiles/default.jpg @endif"></a>
					</div>
					<div class="dropdown profile-action">
						<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a data-id="{{$task->id}}" data-task_name="{{$task->task_name}}" data-task_description="{{$task->task_description}}" data-task_deadline="{{$task->task_deadline}}" data-task_priority="{{$task->task_priority}}" data-image="{{$task->image}}" data-company="{{$task->company}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
						<a data-id="{{$task->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
					</div>
					</div>
					<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$task->task_name}}</a></h4>
					<h5 class="user-name m-t-10 mb-0 text-ellipsis"><a href="javascript:void(0)">{{$task->firstname}} {{$task->lastname}}</a></h5>
					
				</div>
			</div>
		@endforeach
		<x-modals.delete :route="'task.destroy'" :title="'Task'" />

		<!-- Edit Client Modal -->
		<div id="edit_client" class="modal custom-modal fade" role="dialog">
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
								<input type="date" name="task_deadline" id="task_deadline" class="form-control datepicker" required
								 min="<?php echo date('Y-m-d', strtotime('+10 days')); ?>">
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


											
							<div class="form-group">
							<label class="col-form-label">image</span></label>
							<input class="form-control floating edit_image" name="image" type="file">
							</div>
																	
							<!-- Submit Button -->
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>

					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Client Modal -->
	@endif
	
</div>




{{-- MODELS --}}
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

					<form method="POST" enctype="multipart/form-data" action="{{route('tasks.add')}}">
										@csrf
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


										
						<div class="form-group">
						<label class="col-form-label">image</span></label>
						<input class="form-control floating edit_image" name="image" type="file">
						</div>
																
						<!-- Submit Button -->
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

			</div>
		</div>
	</div>
</div>
{{-- end task mode --}}
@endsection


@section('scripts')
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_task').modal('show');
			var id = $(this).data('id');
			var task_name = $(this).data('task_name');
			var task_description = $(this).data('task_description');
			var task_deadline = $(this).data('task_deadline');
			var task_priority = $(this).data('task_priority');
			

			$('#edit_id').val(id);
			$('.edit_task_name').val(task_name);
			$('.edit_task_description').val(task_description);
			$('.edit_task_deadline').val(task_deadline);
			$('.edit_task_priority').val(task_priority);
			// $('.edit_avatar').val(avatar);
			// $('.edit_company').val(company);
		})
	})
</script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+5d',
            autoclose: true
        });
    });
</script>
@endsection
