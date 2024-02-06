
var dropdownItems = document.querySelectorAll('.lang-set');

dropdownItems.forEach(function (item) {
    item.addEventListener('click', function () {
        var selectedLanguage = item.getAttribute('data-lang');
        document.cookie = 'admin_language=' + selectedLanguage + '; expires=' + new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';

        location.reload();
    });
});


// delete
$(document).ready(function () {
    var deleteItemId;
    var deleteTableName;

    $('.delete-item').on('click', function () {
        deleteItemId = $(this).data('id');
        deleteTableName = $(this).data('table');
    });

    $('.confirm-delete').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '../icore/json/table_delete.php',
            data: { id: deleteItemId, table: deleteTableName },
            success: function (response) {
                console.log(response);
                $('#deleteModal').modal('hide');
                setTimeout(x => {
                    location.reload();
                }, 2500)
            },
            error: function (error) {
                $('#dangerModal').modal('show');
            }
        });
    });
});

// active
$(document).ready(function () {
    var activeItemId;
    var activeTableName;

    $('.active-item').on('click', function () {
        activeItemId = $(this).data('id');
        activeTableName = $(this).data('table');
    });

    $('.confirm-active').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '../icore/json/table_active.php',
            data: { id: activeItemId, table: activeTableName },
            success: function (response) {
                console.log(response);
                $('#activeModal').modal('hide');
                setTimeout(x => {
                    location.reload();
                }, 2500)
            },
            error: function (error) {
                $('#dangerModal').modal('show');
            }
        });
    });
});
// inactive
$(document).ready(function () {
    var inactiveItemId;
    var inactiveTableName;

    $('.inactive-item').on('click', function () {
        inactiveItemId = $(this).data('id');
        inactiveTableName = $(this).data('table');
    });

    $('.confirm-inactive').on('click', function () {
        $.ajax({
            type: 'POST',
            url: '../icore/json/table_inactive.php',
            data: { id: inactiveItemId, table: inactiveTableName },
            success: function (response) {
                console.log(response);
                $('#inactiveModal').modal('hide');
                setTimeout(x => {
                    location.reload();
                }, 2500)
            },
            error: function (error) {
                $('#dangerModal').modal('show');
            }
        });
    });
});

// add table

$(document).ready(function () {
    $('#addDataBtn').on('click', function () {
        var formAddData = {};
        $('.addField').each(function () {
            var fieldName = $(this).attr('name');
            var fieldValue = $(this).val();
            formAddData[fieldName] = fieldValue;
        });

        $.ajax({
            type: 'POST',
            url: '../icore/json/table_add.php',
            data: { formAddData: JSON.stringify(formAddData) },
            success: function (response) {
                console.log(response);
                $('#addModal').modal('hide');
                setTimeout(x => {
                    location.reload();
                }, 2500)

            },
            error: function (error) {
                $('#danger-alert-modal').modal('show');
            }
        });
    });
});

// edit get details
$(document).ready(function () {
    $('.edit-item').on('click', function () {
        var tableId = $(this).data('id');
        var tableName = $(this).data('table');

        $.ajax({
            type: 'POST',
            url: '../icore/json/get_table_details.php',
            data: { tableId: tableId, tableName: tableName },
            success: function (response) {
                var dataDetails = JSON.parse(response);

                // جمع‌آوری اطلاعات از فیلدهای ورودی با کلاس editField
                $('.editField').each(function () {
                    var fieldName = $(this).attr('name');
                    $(this).val(dataDetails[fieldName]);
                });

                $('#editModal').modal('show');
            },
            error: function (error) {
                $('#danger-alert-modal').modal('show');
            }
        });
    });
    // edit
    $('#editDataBtn').on('click', function () {
        var formEditData = {};
        $('.editField').each(function () {
            var fieldName = $(this).attr('name');
            var fieldValue = $(this).val();
            formEditData[fieldName] = fieldValue;
        });

        $.ajax({
            type: 'POST',
            url: '../icore/json/table_edit.php',
            data: { formEditData: JSON.stringify(formEditData) },
            success: function (response) {
                console.log(response);
                $('#editModal').modal('hide');

                setTimeout(x => {
                    location.reload();
                }, 2500)

            },
            error: function (error) {
                $('#danger-alert-modal').modal('show');

            }
        });
    });
});



// multi select 

$(document).ready(function () {
    $('#optgroup').multiSelect({ selectableOptgroup: true });
});


// edit status


$(document).ready(function () {
    // گوش دادن به رویداد کلیک بر روی لینک‌ها
    $('.operation-link').click(function () {
        // گرفتن مقدار دیتا-آتریبیوت مرتبط با لینک
        var operation = $(this).data('operation');
        var table_set = $(this).data('tableset');
        var id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "../icore/json/edit_status.php", // فایل PHP پردازش
            data: { operation: operation, table_set: table_set, id: id },
            success: function (response) {
                console.log(response);
                setTimeout(x => {
                    location.reload();
                }, 2500)

            }
        });
    });
});





