<div class="modal fade" id="post-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <form name="userForm" class="form-horizontal">
               <input type="hidden" name="post_id" id="post_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        <span id="titleError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2">Description</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4" cols="50">
                        </textarea>
                        <span id="descriptionError" class="alert-message"></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
        </div>
    </div>
  </div>