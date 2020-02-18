$(document).ready(function () {
    var categories = []
    $.ajax({
        type: "GET",
        url: "/admin/movies/categories",
        success: function(response){
            for(var i = 0; i < response.categories.length; i++){
                categories.push(response.categories[i]);
                $('#form-category').append('<option> name: ' + response.categories[i].name+ '   id: ' + response.categories[i].category_id + '</option>')
                $('#form-category-edit').append('<option> name: ' + response.categories[i].name+ '   id: ' + response.categories[i].category_id + '</option>')
            }
        }
    })

        var table = $('#movies-table').DataTable({
             processing: true,
             serverSide: true,
             ajax: '/admin/movies/list',
             columns: [
                 { data: 'id', name: 'id' },
                 { data: 'name', name: 'name' },
                 { data: 'description', name: 'description' },
                 { data: 'price', name: 'price'},
                 { data: 'category_id', name: 'category'},
                 {
                     "data": "id", name: "id",
                     "render": function(data){
                         return "<button type='submit' id='" + data + "' class='btn btn-warning table-btn'  data-toggle='modal' data-target='#editMovieModal'>Edit <i class='fa fa-pencil' aria-hidden='true'></i></button>"
                     }
                 },

                 {
                     "data": "id", name: "id",
                     "render": function(data){
                         return "<button type='submit' id='" + data + "' class='btn btn-danger table-btn'  data-toggle='modal' data-target='#deleteMovieModal'>Delete <i class='fa fa-ban' aria-hidden='true'></i></button>"
                     }
                 }
             ]
             });
     var movieId = 0;
     $('.container').on('click', '.table-btn' ,function(e){
         movieId = $(this).get(0).id;
     })

     $('#addMovieModal button:submit').on('click', function(e) {
         e.preventDefault();

         $.ajax({
                 type: "POST",
                 url: "/admin/movies/add",
                 data: {
                 name : $('#form-name').val(),
                 description : $('#form-description').val(),
                 price : $('#form-price').val(),
                 image : $('#form-image').val(),
                 trailer : $('#form-trailer').val(),
                 category : $('#form-category').children("option:selected").val(),
                 "_token": $('#token').val(),
                 },
                 success: function(response){
                    $('#addMovieModal').modal('hide')
                     $('#form-name').val("")
                     $('#form-description').val("")
                     $('#form-price').val("")
                     $('#form-image').val("")
                     $('#form-trailer').val("")
                     table.ajax.reload();
                     toastr.success(response.notification.message, 'Success');
                 },
                 error: function(error){
                    toastr.error(error.responseJSON.error, "Error")
                 }
             })
     })

     $('.container #deleteMovieModal button:submit').on('click', function(e){
         e.preventDefault();
         $.ajax({
             type: "DELETE",
             url: "/admin/movies/delete",
             data : {
                 movie_id : movieId,
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
     $('.container #editMovieModal').on("shown.bs.modal", function(e){
         var row = ($('#' + movieId).parent().parent());
         var first = row.children().first().siblings();
         $('#editMovieModal #form-name-edit').val(first.html());
         $('#editMovieModal #form-description-edit').val(first.next().html());
         $('#editMovieModal #form-price-edit').val(first.next().next().html());
     })

     $('.container #editMovieModal button:submit').on('click', function(e){
         e.preventDefault();
         $.ajax({
             type: "PUT",
             url: "/admin/movies/edit",
             data : {
                 movie_id : movieId,
                 name : $('#form-name-edit').val(),
                 description : $('#form-description-edit').val(),
                 price : $('#form-price-edit').val(),
                 image : $('#form-image-edit').val(),
                 trailer : $('#form-trailer-edit').val(),
                 category : $('#form-category-edit').children("option:selected").val(),
                 "_token": $('#token').val(),
             },
             success: function(response){
                 $('#editMovieModal').modal('hide');
                 table.ajax.reload();
                 toastr.success(response.notification.message, "Success");
             },
             error: function(error){
                toastr.error(error.responseJSON.error, "Error")
             }
         })
     })

    });
