function notification(type, message) {
    if (type == "success") {
        toastr.success(message);
    } else if (type == "error") {
        toastr.error(message);
    }
}

function loader(type) {
    if (type) {
        $("#loaderModal").show();
    } else {
        $("#loaderModal").hide();
    }
}

function confirmStatusModal(id, status, datatable_id, msg) {
    let url = "";

    if (status === 0 || status === 1 || status === 2 || status === 3 || status === 4) {
        url = $(`.${datatable_id}_status`).html().replace(/ID/g, id).replace(/STATUS/g, status);
    } else {
        return false;
    }

    let text = "Are you sure you want to disable?";

    if (status === 1) {
        text = "Are you sure you want to enable?";
    } else if (status === 2) {
        text = "Are you sure you want to delete?";
    } else if (status === 3) {
        text = "Are you sure you want to make offline?";
    } else if (status === 4) {
        text = "Are you sure you want to make online?";
    }

    text = msg || text;

    Swal.fire({
        title: "Confirmation",
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
    }).then(function (result) {
        if (result.isConfirmed) {
            loader(true);
            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.response === "success") {
                        notification("success", data.message, 5);
                    } else {
                        notification("error", data.message, 15);
                    }

                    $("#" + datatable_id).DataTable().draw(false);
                    loader(false);
                },
                error: function (data) {
                    errorHandler(data);
                    loader(false);
                },
            });
        }
    });
    return false;
}

function errorHandler(data) {
    var html = [];

    if (data.responseJSON.errors !== undefined) {
        var errors = data.responseJSON.errors;
        var dot = false;
        if (Object.keys(errors).length > 1) {
            dot = true;
        }
        $.each(errors, function (index, value) {
            if (dot) {
                value = "&bull; " + value;
            }
            html.push(value);
        });
    } else {
        html.push("Something went wrong.");
    }

    notification("error", html.join("<br/>"));
}

function hideModel(id){
    $("#"+id).modal('hide');
}
