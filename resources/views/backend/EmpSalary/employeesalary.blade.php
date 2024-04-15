<form method="post" action="{{ route('salary.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="salary">Salary</label>
        <input type="number" name="salary" id="salary" class="form-control">
    </div>
    <!-- Other fields as needed -->

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
