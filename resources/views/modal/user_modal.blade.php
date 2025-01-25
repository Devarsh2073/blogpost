<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="user-form" action="{{ route('admin.users.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="recordName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="recordName" placeholder="Enter Name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="recordEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="recordEmail" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3" id="passwordBlock">
                        <label for="recordPassword" class="form-label">Password</label>
                        <input class="form-control" id="recordPassword" name="password" type="password" placeholder="Enter Password"></input>
                    </div>
                    <div class="mb-3">
                        <label for="recordRole" class="form-label">Role</label>
                        <select class="form-select" id="recordRole" name="role" placeholder="Select Role" required>
                            @foreach ($roles as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
