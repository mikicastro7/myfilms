$(document).ready(function () {
    var table = $('#categories-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '/admin/categories/list',
         columns: [
             { data: 'id', name: 'id' },
             { data: 'name', name: 'name' },
             { data: 'description', name: 'description' },
             {
                 "data": "id", name: "id",
                 "render": function(data){
                     return "<button type='submit' id='" + data + "' class='btn btn-warning table-btn'  data-toggle='modal' data-target='#editCategoryModal'>Edit <i class='fa fa-pencil' aria-hidden='true'></i></button>"
                 }
             },

             {
                 "data": "id", name: "id",
                 "render": function(data){
                     return "<button type='submit' id='" + data + "' class='btn btn-danger table-btn'  data-toggle='modal' data-target='#deleteCategoryModal'>Delete <i class='fa fa-ban' aria-hidden='true'></i></button>"
                 }
             }
         ]

         });
 var categoryId = 0;
 $('.container').on('click', '.table-btn' ,function(e){
     categoryId = $(this).get(0).id;
 })

 $('#addCategoryModal button:submit').on('click', function(e) {
     e.preventDefault();

     $.ajax({
             type: "POST",
             url: "/admin/categories/add",
             data: {
             name : $('#form-name').val(),
             description : $('#form-description').val(),
             "_token": $('#token').val(),
             },
             success: function(response){
                 $('#addCategoryModal').modal('hide')
                 $('#form-name').val(""),
                 $('#form-description').val(""),
                 table.ajax.reload();
                 toastr.success(response.notification.message, 'Success');
             },
             error: function(error){
                 if (error.responseJSON.error == undefined){
                     toastr.error("Error with the server", "Error")
                 } else {
                     toastr.error(error.responseJSON.error, "Error")
                 }
             }
         })
 })

 $('.container #deleteCategoryModal button:submit').on('click', function(e){
     e.preventDefault();
     $.ajax({
         type: "DELETE",
         url: "/admin/categories/delete",
         data : {
             category_id : categoryId,
             "_token": $('#token').val(),
         },
         success: function(response){
             table.ajax.reload();
             toastr.success(response.notification.message, 'Success');
         },
         error: function(error){
            if (error.responseJSON.error == undefined){
                 toastr.error("Error with the server", "Error")
            } else {
                 toastr.error(error.responseJSON.error, "Error")
            }
        }
     })
 })

 $('.container #editCategoryModal').on("shown.bs.modal", function(e){
     var row = ($('#' + categoryId).parent().parent());
     var first = row.children().first().siblings();
     $('#editCategoryModal #form-name-edit').val(first.html());
     $('#editCategoryModal #form-description-edit').val(first.next().html());
 })

 $('.container #editCategoryModal button:submit').on('click', function(e){
     e.preventDefault();
     $.ajax({
         type: "PUT",
         url: "/admin/categories/edit",
         data : {
             category_id : categoryId,
             name : $('#form-name-edit').val(),
             description : $('#form-description-edit').val(),
             "_token": $('#token').val(),
         },
         success: function(response){
             $('#editCategoryModal').modal('hide')
             table.ajax.reload();
             $('#form-name-edit').val(""),
             $('#form-description-edit').val(""),
             toastr.success(response.notification.message, "Success");
         },
         error: function(error){
            if (error.responseJSON.error == undefined){
                 toastr.error("Error with the server", "Error")
            } else {
                 toastr.error(error.responseJSON.error, "Error")
            }
        }
     })
 })

});
