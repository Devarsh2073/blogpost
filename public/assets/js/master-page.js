function deleteProperty(url, dataId) {
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            _method: "DELETE",
        },
        success: function (response) {
            var modalId = "#confirmationModal";
            if (!response.success) {
                toastr.error("Something went wrong, please try again.");
            } else {
                $(modalId).modal("hide");
                $(".modal-backdrop").remove();
                $(dataId).DataTable().ajax.reload();
                toastr.success(response.message);
            }
        },
        error: function (xhr, status, error) {
            toastr.error("An error occurred, please try again.");
        },
    });
}