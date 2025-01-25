<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="post-form" action="{{ route('admin.post.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="recordTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="tittle" id="recordTitle" placeholder="Enter Tittle" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="recordDate" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="recordDate" placeholder="Enter Date" required>
                    </div>
                    <div class="mb-3">
                        <label for="recordDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="recordDescription" name="description" placeholder="Enter Description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
