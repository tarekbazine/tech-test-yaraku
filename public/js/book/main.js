$(document).ready(function () {

    /***********************************
     *  Setup data table
     ***********************************/
    $('#books_list').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        // "bAutoWidth": false,

        'columnDefs': [ // see https://datatables.net/reference/option/columns.searchable
            {
                'searchable': false,
                'targets': [2]
            },
            {
                "orderable": false,
                "targets": [2]
            }
        ]
    });


    /***********************************
     *  delete Modal
     ***********************************/
    var deleteBookModal = $('#delete_modal')
    deleteBookModal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var dataSource = button.closest('tr')

        var bookTitle = dataSource.data('book_title') // Extract info from data-* attributes
        var bookId = dataSource.data('book_id') // Extract info from data-* attributes

        var modal = $(this)
        modal.find('mark').text(bookTitle)
        modal.find('#delete-form').attr('action', deleteBookActionUrl.replace("#", bookId))
    })


    /***********************************
     *  edit Modal
     ***********************************/
    var editAuthorBookModal = $('#edit_author_modal')
    editAuthorBookModal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var dataSource = button.closest('tr')

        var bookAuthorName = dataSource.data('book_author_name') // Extract info from data-* attributes
        var bookTitle = dataSource.data('book_title') // Extract info from data-* attributes
        var bookId = dataSource.data('book_id') // Extract info from data-* attributes

        var modal = $(this)
        modal.find('mark').text(bookTitle)
        modal.find('input[name="author_name"]').val(bookAuthorName)
        modal.find('#edit_author-form').attr('action', editAuthorBookActionUrl.replace("#", bookId))

    })
    editAuthorBookModal.on('shown.bs.modal', function (event) {
        var modal = $(this)

        modal.find('input[name="author_name"]')[0].focus()
    })

});