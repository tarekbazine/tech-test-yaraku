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
                        <tr data-book_id="{{ $book->id }}"
                            data-book_title="{{ $book->title }}"
                            data-book_author_name="{{ $book->author_name }}"
                        >
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author_name }}</td>
                            <td>
                                <button type="button"
                                        data-toggle="modal"
                                        data-target="#edit_author_modal"
                                        class="btn btn-success btn-sm">
                                    Edit
                                </button>
                                <button type="button"
                                        data-toggle="modal"
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

    @include('front_end.book._partials.edit_author_modal')

    @include('front_end.book._partials.delete_modal')

    @include('front_end.book._partials.export_modal')

    @include('vendor.flash.message')
@endsection

@section('css')
    <link href="{{ asset('/node_modules/bootstrap/dist/css/bootstrap.min.css') }}"
          rel="stylesheet" type="text/css">

    <link href="{{ asset('/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
          rel="stylesheet" type="text/css"/>

    <link href="{{ asset('/css/books.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')

    <script src="{{ asset('/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('/node_modules/file-saverjs/FileSaver.min.js') }}"></script>
    <script src="{{ asset('/node_modules/tableexport/dist/js/tableexport.min.js') }}"></script>
    <script src="{{ asset('/node_modules/xml-js/dist/xml-js.min.js') }}"></script>

    <script>
        var deleteBookActionUrl = "{!! route('books.destroy',['book'=>"#"]) !!}"
        var editAuthorBookActionUrl = "{!! route('books.update_author',['book'=>"#"]) !!}"
    </script>
    <script src="{{ asset('js/book/main.js') }}"></script>
    <script src="{{ asset('js/book/export.js') }}"></script>


    <script src="{{ asset('js/__.js') }}"></script>


    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreBook::class, '#store-book-form'); !!}
@endsection
