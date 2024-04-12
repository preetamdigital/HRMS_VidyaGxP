@extends('layouts.backend')

@section('styles')	
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
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
		<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_task"><i class="fa fa-plus"></i>Add Task</a>
		<div class="view-icons">
			<a href="{{route('tasks-show')}}" class="grid-view btn btn-link {{route_is('tasks-show') ? 'active' : '' }}"><i class="fa fa-th"></i></a>
			<a href="{{route('tasks-show')}}" class="list-view btn btn-link {{route_is('tasks-show') ? 'active' : '' }}"><i class="fa fa-bars"></i></a>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table datatable">
				<thead>
					<tr>
						<th>Task Name</th>
						<th>Task Description</th>
						<th>Task Deadline</th>
						<th>Task Priority</th>
						<th>Image</th> 
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($tasks->count()))
						@foreach ($tasks as $task)
						<tr>
							{{-- <td>
								<h2 class="table-avatar">
									<a href="client-profile.html" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt=""></a>
									<a href="client-profile.html">Global Technologies</a>
								</h2>
							</td> --}}
							{{-- <td>{{$task->id}}</td> --}}
							<td>{{$task->task_name}}</td> 
                            <td>{{$task->task_description}}</td>
							<td>{{$task->task_deadline}}</td>
							<td>{{$task->task_priority}}</td>
							<td>{{$task->image}}</td>
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-id="{{$task->id}}" data-task_name="{{$task->task_name}}" data-task_description="{{$task->task_description}}" data-task_deadline="{{$task->task_deadline}}" data-task_priority="{{$task->task_priority}}" data-image="{{$task->image}}" class="dropdown-item editbtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a data-id="{{$task->id}}" class="dropdown-item deletebtn" href="javascript:void(0)" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
							</td>
						</tr>
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
										<input type="hidden" id="edit_id" name="id">
												
										<div class="form-group">
											<label for="task_name">Task Name:</label>
											<input type="text" name="task_name" id="task_name" class="form-control edit_task_name" placeholder="Enter task name" required>
										</div>
										
										<!-- Task Description -->
										<div class="form-group">
											<label for="task_description">Task Description:</label>
											<textarea name="task_description" id="task_description" class="form-control edit_task_description" rows="3" placeholder="Enter task description"></textarea>
										</div>
										
										<!-- Task Deadline -->
										<div class="form-group">
											<label for="task_deadline">Task Deadline:</label>
											<input type="date" name="task_deadline" id="task_deadline" class="form-control edit_task_deadline" required>
										</div>
										
										<!-- Task Priority -->
										<div class="form-group">
											<label for="task_priority">Task Priority:</label>
											<select name="task_priority" id="task_priority" class="form-control edit_task_priority" required>
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
				</tbody>
			</table>
		</div>
	</div>
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
<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
	$(document).ready(function (){
		$('.editbtn').on('click',function (){
			$('#edit_client').modal('show');
			var id = $(this).data('id');
			var firstname = $(this).data('task_name');
			var lastname = $(this).data('task_description');
			var email = $(this).data('task_deadline');
			var phone = $(this).data('task_priority');
			var avatar = $(this).data('image');
			//var company = $(this).data('company');

			$('#edit_id').val(id);
			$('.edit_task_name').val(firstname);
			$('.edit_task_description').val(lastname);
			$('.edit_task_deadline').val(email);
			$('.edit_task_priority').val(phone);
			$('.edit_image').val(avatar);
			//$('.edit_company').val(company);
		})
	})
</script>
@endsection


