<div class="modal fade" id="delete_modal" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <span>Do you want to delete "</span><mark class="delete-modal__book-name">Xxx</mark>" book ?
            </div>

            <div class="modal-footer">
                <form id="delete-form" action="#" method="POST">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="delete-btn">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>