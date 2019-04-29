<div class="modal fade" id="edit_author_modal" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit the autor name of the book
                    <mark>Xxx</mark>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="edit_author-form" action="#" method="POST">
                {{ csrf_field() }}

                <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Author:</label>
                        <input name="author_name" type="text" class="form-control" autofocus>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="delete-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>