<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="role-form" action="{{ route('admin.roles.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="recordName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="recordName"
                            placeholder="Enter Name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="recordPermissions" class="form-label">Permissions</label>
                        <div class="accordion accordion-flush" id="permissionsAccordion">
                            <!-- Group: Users -->
                            @foreach ($grpPermission as $key => $permission)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingUsers">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$key}}">
                                        {{ Str::upper($key) }}
                                    </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse show"
                                    aria-labelledby="headingUsers" data-bs-parent="#permissionsAccordion">
                                    <div class="accordion-body">
                                        @foreach ($permission as $value)
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" data-id="{{$value['id']}}" type="checkbox" value="{{$value['name']}}"
                                                id="viewUsers" name="permissions[]">
                                            <label class="form-check-label" for="viewUsers">{{$value['name']}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
