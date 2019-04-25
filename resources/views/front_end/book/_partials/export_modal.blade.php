<div class="modal fade" id="export_modal" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">..</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                           name="radio_export" id="titles_authors"
                           data-ignored_cols="2" value="0,1" checked>
                    <label class="form-check-label" for="titles_authors">
                        A list with Title and Author
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                           name="radio_export" id="titles"
                           data-ignored_cols="1,2" value="0">
                    <label class="form-check-label" for="titles">
                        A list with only Titles
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio"
                           name="radio_export" id="authors"
                           data-ignored_cols="0,2" value="1">
                    <label class="form-check-label" for="authors">
                        A list with only Authors
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="export-btn">Export</button>
            </div>
        </div>
    </div>
</div>