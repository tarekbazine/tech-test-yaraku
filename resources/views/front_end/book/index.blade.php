@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <h3 class="mt-2">Add new Book</h3>

                @include('front_end.book._partials.create_from')


                <div class="row mt-5">
                    <div class="col-md-8">
                        <h3>Books list</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown float-right">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Export data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#export_modal"
                                   data-type="csv" data-modaltitle="Export CSV" href="#">CSV</a>

                                <a class="dropdown-item" data-toggle="modal" data-target="#export_modal"
                                   data-type="xml" data-modaltitle="Export XML" href="#">XML</a>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="books_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author_name }}</td>
                            <td>
                                <button type="button"
                                        data-book_id="{{ $book->id }}"
                                        class="btn btn-success btn-sm">
                                    Edit
                                </button>
                                <button type="button" data-book_id="{{ $book->id }}"
                                        data-toggle="modal"
                                        data-book_title="{{ $book->title }}"
                                        data-target="#delete_modal"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    @include('front_end.book._partials.delete_modal')

    @include('front_end.book._partials.export_modal')

    @include('vendor.flash.message')
@endsection

@section('css')
    <link href="{{ asset('/node_modules/bootstrap/dist/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>

@endsection

@section('js')
    <script
            src="https://code.jquery.com/jquery-3.4.0.min.js"
            integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
            crossorigin="anonymous"></script>
    {{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
    {{--integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
    {{--crossorigin="anonymous"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

    <script src="{{ asset('/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>



    {{--<script type="text/javascript" src="https://unpkg.com/xlsx@0.14.2/dist/xlsx.core.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/file-saverjs@1.3.6/FileSaver.min.js"></script>

    <script type="text/javascript" src="https://unpkg.com/tableexport@5.2.0/dist/js/tableexport.min.js"></script>

    {{--<script src="https://cdn.jsdelivr.net/npm/xml-js@1.6.11/lib/index.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/xml-js@1.6.11/dist/xml-js.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                // "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,

                'columnDefs': [         // see https://datatables.net/reference/option/columns.searchable
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
        });


        var bookListTable = $("table");

        function exportTableToCsv(ignoredCols) {

            var table = bookListTable.tableExport({
                headers: true,                      // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
                footers: false,                      // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
                formats: ["csv"],    // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
                filename: "id",                     // (id, String), filename for the downloaded file, (default: 'id')
                // bootstrap: false,                   // (Boolean), style buttons using bootstrap, (default: true)
                exportButtons: false,                // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
                // position: "bottom",                 // (top, bottom), position of the caption element relative to table, (default: 'bottom')
                ignoreRows: null,                   // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
                ignoreCols: ignoredCols,                   // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
                trimWhitespace: true,               // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
                RTL: false,                         // (Boolean), set direction of the worksheet to right-to-left (default: false)
                sheetname: "books-list"                     // (id, String), sheet name for the exported spreadsheet, (default: 'id')
            });

            var data_table = table.getExportData().books_list.csv;
            // console.log(data_table)
            table.export2file(
                data_table.data,
                data_table.mimeType,
                data_table.filename,
                data_table.fileExtension,
                data_table.merges,
                data_table.RTL,
                data_table.sheetname
            )

            return true
        }


        function exportTableToXML(selectedCols) {
            var colTitles = $.map(bookListTable.find('thead th'), function (i) {
                return $(i).text()
            });

            var data = {
                "_declaration": {"_attributes": {"version": "1.0", "encoding": "utf-8"}},
                bookList: {
                    book: []
                }
            }

            bookListTable.find('tbody > tr').each(function () {
                // console.log($(this), $(this).find('td'))
                var rowData = $.map($(this).find('td'), function (i) {
                    // console.log('i', i)
                    return $(i).text()
                });

                // console.log(rowData)

                var bookObj = {}

                $.each(selectedCols, function (index, value) {
                    bookObj[colTitles[value]] = {
                        "_text": rowData[value]
                    }
                })

                data.bookList.book.push(bookObj)
            });

            var options = {compact: true, ignoreComment: true, spaces: 4};

            trigerFileDownload(js2xml(data, options), 'book-list')

            return true;
        }

        // ddd = exportTableToXML([0, 1])
        // var options = {compact: true, ignoreComment: true, spaces: 4};
        // console.log(js2xml(ddd, options))


        var exportModal = $('#export_modal')
        exportModal.on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modaltitle = button.data('modaltitle') // Extract info from data-* attributes
            var export_type = button.data('type')
            // console.log(export_type)
            var modal = $(this)
            modal.find('.modal-title').text(modaltitle)
            // console.log(modal.find('#export-btn'))
            modal.find('#export-btn').data('type', export_type)
        })

        var exportBtn = $('#export-btn')
        exportBtn.click(function (event) {
            var button = $(this)
            // console.log('me',$(this))
            var export_type = button.data('type')

            // console.log(export_type)

            button.attr('disabled', 'disabled')
            button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Exporting...')

            if ('csv' === export_type) {

                var ignoredCols = exportModal.find('input[name="radio_export"]:checked')
                    .data('ignored_cols').toString()

                ignoredCols = parseStringToArray(ignoredCols)

                console.log(ignoredCols)
                exportTableToCsv(ignoredCols)

            } else if ('xml' === export_type) {

                var selectedCols = exportModal.find('input[name="radio_export"]:checked')
                    .val().toString()

                console.log(selectedCols)

                selectedCols = parseStringToArray(selectedCols)
                console.log(selectedCols)
                exportTableToXML(selectedCols)
            }

            exportModal.modal('hide')
        });

        exportModal.on('hidden.bs.modal', function (event) {
            exportBtn.removeAttr('disabled')
            exportBtn.html('Export')
        })


        function parseStringToArray(str) {
            var arr = str.split(',')

            arr = $.map(arr, function (i) {
                var n = parseInt(i)
                if (isNaN(n)) {
                    throw new Error(" Err in radio export btns ! data-ignored_cols should but arr int");
                }
                return n
            });
            return arr
        }

        function trigerFileDownload(xml, fileName) {
            var uri = 'data:text/xml;charset=utf-8,' + encodeURIComponent(xml);
            var download_link = document.createElement('a');
            download_link.href = uri;
            download_link.download = fileName + ".xml";
            document.body.appendChild(download_link);
            download_link.click();
            document.body.removeChild(download_link);
        }


        //delete js
        var deleteBookModal = $('#delete_modal')
        var deleteBookActionUrl = "{!! route('books.destroy',['book'=>"#"]) !!}"
        deleteBookModal.on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var bookTitle = button.data('book_title') // Extract info from data-* attributes
            var bookId = button.data('book_id') // Extract info from data-* attributes
            // console.log(bookTitle)
            var modal = $(this)
            modal.find('mark').text(bookTitle)
            // console.log(modal.find('#export-btn'))
            modal.find('#delete-form').attr('action', deleteBookActionUrl.replace("#", bookId))
        })



    </script>


    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreBook::class, '#store-book-form'); !!}
@endsection
