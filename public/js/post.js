  var dataTable = $('#bdtask-blog');
  dataTable.DataTable();

  var postModal = $('#post-modal');
  
  function addPost() {
    $("#post_id").val('');
    $('#post-modal').modal('show');
  }

  function editPost(event) {
    var id  = $(event).data("id");
    let _url = baseUrl + `/posts/${id}`;
    $('#titleError').text('');
    $('#descriptionError').text('');

    $.ajax({
      url: _url,
      type: "GET",
      success: function(response) {
          if(response) {
            response = response.data;
            $("#post_id").val(response.id);
            $("#title").val(response.title);
            $("#description").val(response.description);
            $('#post-modal').modal('show');
          }
      }
    });
  }

  function createPost() {
    var title = $('#title').val();
    var description = $('#description').val();
    var id = $("#post_id").val();

    let _url     = baseUrl + `/posts`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: _url,
        type: "POST",
        data: {
          id: id,
          title: title,
          description: description,
          _token: _token
        },
        success: function(response) {
            if(response.code == 200) {
              if(id != ""){
                $("#row_"+id+" td:nth-child(2)").html(response.data.title);
                $("#row_"+id+" td:nth-child(3)").html(response.data.description);
              } else {
                $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.title+'</td><td>'+response.data.description+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td></tr>');
              }
              $('#title').val('');
              $('#description').val('');

              $('#post-modal').modal('hide');
            }
        },
        error: function(response) {
          $('#titleError').text(response.responseJSON.errors.title);
          $('#descriptionError').text(response.responseJSON.errors.description);
        }
      });
  }

  function deletePost(event) {
    var id  = $(event).data("id");
    let _url = baseUrl + `/posts/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: _url,
        type: 'DELETE',
        data: {
          _token: _token
        },
        success: function(response) {
          $("#row_"+id).remove();
        }
      });
  }