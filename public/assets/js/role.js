$('#role-form').on('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    var formObject = {};
    formData.forEach((value, key) => {
        if (formObject[key]) {
            if (!Array.isArray(formObject[key])) {
                formObject[key] = [formObject[key]];
            }
            formObject[key].push(value);
        } else {
            formObject[key] = value;
        }
    });

    $.ajax({
        type: "POST",
        url: e.target.action,
        data: formObject,
        success: function (response) {
            e.target.reset();
            $("#addRecordModal").modal("hide");
            $(".modal-backdrop").remove();
            $('#role-table').DataTable().draw();
            toastr.success(response.message);
        },
        error: function (xhr, status, error) {
            toastr.error('There was an error with the request.');
        }
    });
});

$(document).ready(function () {
    $(document).on('click', '.add-btn', function () {
        var form = $('#role-form');

        form[0].reset();
        form.find('[name="id"]').val('');
    });
    $(document).on('click', '.edit-btn', function () {
        var grpId = $(this).data('id');
        if (grpId) {
            $.ajax({
                method: 'get',
                url: $(this).data('href'),
                success: function (response) {
                    if (response.success) {
                        $('[name="id"]').val(response.data.id);
                        $('[name="name"]').val(response.data.name);
                        if (response.rolePermissions) {
                            Object.keys(response.rolePermissions).forEach(permissionId => {
                                const checkbox = document.querySelector(`.permission-checkbox[data-id="${permissionId}"]`);
                                if (checkbox) {
                                    checkbox.checked = true;
                                }
                            });
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.log(status);
                },
            });
        }
    });
    $(document).on("click", ".delete-btn", function (e) {
        deleteProperty(e.target.dataset.href, e.target.dataset.table);
    });
    $(document).on('click', '.delete-confirmation-button', function () {
        $('#confirmActionButton').attr('data-id', $(this).data('id'));
        $('#confirmActionButton').attr('data-href', $(this).data('href'));
        $('#confirmActionButton').attr('data-table', $(this).data('table'));
    });
});
