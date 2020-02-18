$(document).ready(function () {
    var table = $('#users-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '/admin/users/list',
         columns: [
             { data: 'id', name: 'id' },
             { data: 'name', name: 'name' },
             { data: 'email', name: 'email' },
             { data: 'type', name: 'type'},
             {
                 "data": "id", name: "id",
                 "render": function(data){
                     return "<button type='submit' id='" + data + "' class='btn btn-warning table-btn'  data-toggle='modal' data-target='#editUserModal'>Edit <i class='fa fa-pencil' aria-hidden='true'></i></button>"
                 }
             },

             {
                 "data": "id", name: "id",
                 "render": function(data){
                     return "<button type='submit' id='" + data + "' class='btn btn-danger table-btn'  data-toggle='modal' data-target='#deleteUserModal'>Delete <i class='fa fa-ban' aria-hidden='true'></i></button>"
                 }
             }
         ]

         });
 var userId = 0;
 $('.container').on('click', '.table-btn' ,function(e){
     userId = $(this).get(0).id;
 })

 $('#addUserModal button:submit').on('click', function(e) {
     e.preventDefault();

     $.ajax({
             type: "POST",
             url: "/admin/users/add",
             data: {
             name : $('#form-name').val(),
             type : $('#form-type').val(),
             email : $('#form-email').val(),
             password : $('#form-password').val(),
             "_token": $('#token').val(),
             },
             success: function(response){
                 $('#addUserModal').modal('hide')
                 $('#form-name').val(""),
                 $('#form-type').val(""),
                 $('#form-email').val(""),
                 $('#form-password').val("")
                 table.ajax.reload();
                 toastr.success(response.notification.message, 'Success');
             },
             error: function(error){
                 if (error.responseJSON.error == undefined){
                     toastr.error("The email it's taken", "Error")
                 } else {
                     toastr.error(error.responseJSON.error, "Error")
                 }
             }
         })
 })


 $('.container #deleteUserModal button:submit').on('click', function(e){
     e.preventDefault();
     $.ajax({
         type: "DELETE",
         url: "/admin/users/delete",
         data : {
             user_id : userId,
             "_token": $('#token').val(),
         },
         success: function(response){
             table.ajax.reload();
             toastr.success(response.notification.message, 'Success');
         },
         error: function(error){
                toastr.error(error.responseJSON.error, "Error")
         }
     })
 })
 $('.container #editUserModal').on("shown.bs.modal", function(e){
     var row = ($('#' + userId).parent().parent());
     var first = row.children().first().siblings();
     $('#editUserModal #form-name-edit').val(first.html());
     $('#editUserModal #form-email-edit').val(first.next().html());
     $('#editUserModal #form-type-edit').val(first.next().next().html());
 })

 $('.container #editUserModal button:submit').on('click', function(e){
     e.preventDefault();
     $.ajax({
         type: "PUT",
         url: "/admin/users/edit",
         data : {
             user_id : userId,
             name : $('#form-name-edit').val(),
             type : $('#form-type-edit').val(),
             email : $('#form-email-edit').val(),
             password : $('#form-password-edit').val(),
             "_token": $('#token-edit').val(),
         },
         success: function(response){
             $('#editUserModal').modal('hide')
             table.ajax.reload();
             $('#form-name-edit').val(""),
             $('#form-type-edit').val(""),
             $('#form-email-edit').val(""),
             $('#form-password-edit').val(""),
             toastr.success(response.notification.message, "Success");
         },
         error: function(error){
             if (error.responseJSON.error == undefined){
                 toastr.error("The email it's taken", "Error")
             } else {
                 toastr.error(error.responseJSON.error, "Error")
             }
         }
     })
 })

});
