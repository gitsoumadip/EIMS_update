$(document).ready(function () {
    filtering();

    // Delete the checked items
    $(document).on("click", "#deleteChecked", function () {
        confirmDeleteMultiple(MODULE_CONTROLLER);
    });

    // Form Validations
    $("#modalForm").validate({
        errorElement: "i",
        errorClass: "msg msg-error",
        rules: {
            title: {
                required: true,
                minlength: 3,
                maxlength: 100,
            },
            hyper_link:{
                url:true,
            },
            position: {
                required: true,
            },
            sequence: {
                required: true,
            },
            image: {
                required: function () {
                    return $("#formMethod").val() == "POST" ? true : false;
                },
                accept: "jpg,jpeg,png",
            },
        },
        messages: {
            title: {
                required: "Please enter banner title",
                minlength: "Title should not be less than 3 characters long",
                maxlength: "Title should not be more than 100 characters long",
            },
            hyper_link:{
                url:"Please enter valid url",
            },
            position: {
                required: "Please select position",
            },
            sequence: {
                required: "Please enter sequence number",
            },
            image: {
                required: "Image must not be empty",
                accept: "Please select valid image",
            },
        },
        submitHandler: function (form) {
            let data = new FormData(form);
            ajaxJqueryValidateSubmit(form, data);
        },
    });

    // Opening Create modal
    $("#openModalButton").click(function () {
        $("i.msg-error").hide();
        $("#modalForm")[0].reset();
        $("#formHead").text("Add Banner");
        $("#modalForm").attr("action", `${SITE_URL}admin/${MODULE_CONTROLLER}`);
        $("#formMethod").val("POST");

        openRightModal();
    });
});

// Populating Modules Table via jquery datatable using ajax
const filtering = () => {
    dataTable = $("#moduleTable").DataTable({
        columnDefs: [
            {
                orderable: false,
                targets: [0, 1, 2, 3, 6, 8],
            },
            { width: "5%", targets: 0 },
        ],
        dom: "Bfrtip",
        buttons: [
            "pageLength",
            `<div style="width: 100px;">
                <div class="form-element mb-0">
                    <button type="button" class="c2a size:tiny danger no-animation"
                        id="deleteChecked" style="display:none;padding:7px 10px">
                        <i data-feather="trash"></i>
                        <span style="margin-top:3px">Delete</span>                        
                    </button>
                </div>
            </div>`,
        ],
        searching: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${SITE_URL}admin/${MODULE_CONTROLLER}/fetch`,
            dataSrc: "data",
            data: function (d) {
                return $.extend({}, d, {
                    search_master: $("#searchMaster").val(),
                    search_keyword: $("#searchKeyword").val().toLowerCase(),
                });
            },
        },
        drawCallback: function () {
            feather.replace();
        },
        lengthMenu: [10, 20, 30],
        columns: [
            {
                data: function (data) {
                    return `<div class="form-style">
                            <div class="form-checkbox flow-rootx">
                                <label>
                                    <input type="checkbox" class="single_check" value="${data.id}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>`;
                },
                title: `<div class="form-style">
                            <div class="form-checkbox flow-rootx">
                                <label>
                                    <input type="checkbox" class="all_check" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                      </div>`,
            },
            {
                data: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                title: "Sl",
            },
            {
                data: function (data) {
                    return `
                        <div class="card-action">
                            <a class="button--2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <ul class="left-flow">
                                <li><a href="javascript:void(0)" onclick="showEditModal(${
                                    data.id
                                })"><i data-feather="edit"></i> Edit</a></li>
                                <li>
                                    <a href="javascript:void(0)" onclick="confirmDelete(this)" data-href="${
                                        SITE_URL +
                                        "admin/" +
                                        MODULE_CONTROLLER +
                                        "/" +
                                        data.id
                                    }">
                                    <i data-feather="trash"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                        `;
                },
                title: "Action",
            },
            {
                data: function (data) {
                    return `<img width="80px" src="${SITE_URL}storage/uploads/banner-image/${data.image}"/>`;
                },
                title: "Image",
            },
            {
                data: "title",
                title: "Title",
            },
            {
                data: "hyper_link",
                title: "Hyper Link",
            },
            {
                data: "content",
                title: "Content",
            },
            {
                data: "name",
                title: "Position",
            },
            {
                data: function (data) {
                    let t = "Active",
                        c = "success",
                        s = 0;
                    if (data.status == 0) {
                        (t = "Inactive"), (c = "danger"), (s = 1);
                    }

                    return `<div style="cursor:pointer" class="status-change" data-name="${data.title}" data-id="${data.id}" data-status="${s}" ><span class="badge ${c} radius:tiny size:tiny padding:tiny">${t}</span></div>`;
                },
                title: "Status",
            },
        ],
    });
};

//Opening Edit modal
function showEditModal(id) {
    $.get(`${SITE_URL}admin/${MODULE_CONTROLLER}/${id}/edit`, function (res) {
        if (res.code == 1) {
            $("i.msg-error").hide();
            $("#modalForm")[0].reset();

            $("#modalForm").attr(
                "action",
                `${SITE_URL}admin/${MODULE_CONTROLLER}/${id}`
            );
            $("#formMethod").val("PUT");
            $("#title").val(res.data.title);
            $("#sequence").val(res.data.sequence);
            $("#hyperLink").val(res.data.hyper_link);
            $("#content").val(res.data.content);
            $("#position").val(res.data.position);

            $("#formHead").text("Edit Banner");

            openRightModal();
        } else {
            alertify.error("Error Occurred!");
        }
    });
}
