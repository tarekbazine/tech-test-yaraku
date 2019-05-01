
/***********************************
 *  Csv export
 ***********************************/
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



/***********************************
 *  Xml export
 ***********************************/
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

        var rowData = $.map($(this).find('td'), function (i) {
            return $(i).text()
        });

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



var exportModal = $('#export_modal')
exportModal.on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal

    var modaltitle = button.data('modaltitle') // Extract info from data-* attributes
    var export_type = button.data('type')

    var modal = $(this)
    modal.find('.modal-title').text(modaltitle)
    modal.find('#export-btn').data('type', export_type)
})

var exportBtn = $('#export-btn')
exportBtn.click(function (event) {
    var button = $(this)
    var export_type = button.data('type')

    button.attr('disabled', 'disabled')
    button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Exporting...')

    if ('csv' === export_type) {

        var ignoredCols = exportModal.find('input[name="radio_export"]:checked')
            .data('ignored_cols').toString()

        ignoredCols = parseStringToArray(ignoredCols)

        exportTableToCsv(ignoredCols)

    } else if ('xml' === export_type) {

        var selectedCols = exportModal.find('input[name="radio_export"]:checked')
            .val().toString()

        selectedCols = parseStringToArray(selectedCols)
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