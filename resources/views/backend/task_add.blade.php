@extends('layouts.backend')

@section('styles')

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
			{{-- <a href="{{route('task')}}" class="grid-view btn btn-link {{route_is('task') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('task-list')}}" class="list-view btn btn-link {{route_is('task-list') ? 'active' : '' }}"><i class="fa fa-bars"></i></a> --}}
		</div>
	</div>
</div>
@endsection

@section('content')


<div class="row staff-grid-row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
					<tr>
						<th>Name</th>
						<th>deadline</th>
						<th>priority</th>
						<th class="text-right no-sort">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tasks as $task)
					<tr>
					
						<td>{{$task->task_name}}</td>
						<td>{{date_format(date_create($task->task_deadline),"d M,Y")}}</td>
						<td>{{$task->task_priority}}</td>
						
						<td class="text-right">
							<div class="dropdown dropdown-action">
								<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a data-id="{{$task->id}}" data-firstname="{{$task->task_name}}"  data-task_deadline="{{$task->task_deadline}}"  data-task_priority="{{$task->task_priority}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<a data-id="{{$task->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
					<x-modals.delete :route="'task'" :title="'Task'" />
				</tbody>
			</table>
		</div>
	</div>
	
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
					<div class="form-group">
						<label for="task_name">Task Name:</label>
						<input type="text" name="task_name" id="task_name" class="form-control" placeholder="Enter task name" required>
					</div>
					
					<!-- Task Description -->
				
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
						<label for="task_description">Task Description:</label>
						<textarea name="task_description" id="task_description" class="form-control" rows="3" placeholder="Enter task description"></textarea>
					</div>
					
					
					<div class="submit-section">
						<button class="btn btn-primary submit-btn">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Add Client Modal -->
@endsection

@section('scripts')
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_client').modal('show');
			var id = $(this).data('id');
			var firstname = $(this).data('firstname');
			var lastname = $(this).data('lastname');
			var email = $(this).data('email');
			var phone = $(this).data('phone');
			var avatar = $(this).data('avatar');
			var company = $(this).data('company');

			$('#edit_id').val(id);
			$('.edit_firstname').val(firstname);
			$('.edit_lastname').val(lastname);
			$('.edit_email').val(email);
			$('.edit_phone').val(phone);
			$('.edit_company').val(company);
			$('.edit_avatar').val(avatar);
		})
	})
</script>
@endsection
