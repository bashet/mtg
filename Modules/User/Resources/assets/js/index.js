/**
 * Created by Bashet on 12/06/2016.
 */
$(function () {

    $('.switch').checkboxpicker();

    $('#users').DataTable({
         responsive: true,
         "columnDefs": [
             {
                 "targets": [4,5],
                 "orderable": false
             }
         ],
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10', '25', '50', '100', 'All' ]
        ],
        "autoWidth" : true,
        dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>"
    });

    $('#users').on('click','.delete_user', function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: "You are about to delete an User!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result){
            if (result.value) {
                window.location.href = link;
            }
        });
    });


    $('.switch:checkbox').checkboxpicker().on('change', function () {

        var data = $(this).data();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/user/change-status",
            datatype: 'JSON',
            data:{id:data.id}
        }).done(function (result) {
            swal({
                position: 'top-end',
                type: 'success',
                title: 'User Status Updated!',
                showConfirmButton: false,
                timer: 1500
            });
        });

    });
    

});
