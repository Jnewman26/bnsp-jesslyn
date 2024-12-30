@extends('Layout.layout')

@section('content')
    <div class="d-flex justify-content-between">
        <h2>Book</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBookModal">Create Book</button>
    </div>
    <hr>

    <!-- Modal -->
    <div class="modal fade" id="createBookModal" tabindex="-1" aria-labelledby="createBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="{{ url('book') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createBookModalLabel">Create Book</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book ISBN <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_id" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_name" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Genre <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_genre" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Author <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_author" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Release <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_release" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Publisher <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_publisher" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Book Stock <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="book_stock" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ISBN</th>
                <th>Name</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Release</th>
                <th>Publisher</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($book as $item)
                <tr>
                    <td>{{ $item->book_id }}</td>
                    <td>{{ $item->book_name }}</td>
                    <td>{{ $item->book_genre }}</td>
                    <td>{{ $item->book_author }}</td>
                    <td>{{ $item->book_release }}</td>
                    <td>{{ $item->book_publisher }}</td>
                    <td>{{ $item->book_stock }}</td>
                    <td class="d-flex align-items-center gap-2">
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#borrowModal{{ $item->book_id }}">
                            Borrow
                        </button>
                        <button class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->book_id }}">
                            <i class="fad fa-pen-to-square text-white"></i>
                        </button>
                        <form onsubmit="return confirm('Are you sure to delete this book?')"
                            action="{{ url('book/' . $item->book_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="fad fa-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal edit -->
                <div class="modal fade" id="editModal{{ $item->book_id }}" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ url('book/' . $item->book_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Book</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book ISBN <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_id }}"
                                                name="book_id" disabled>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_name }}"
                                                name="book_name" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Genre <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_genre }}"
                                                name="book_genre" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Author <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_author }}"
                                                name="book_author" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Release <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_release }}"
                                                name="book_release" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Publisher <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                value="{{ $item->book_publisher }}" name="book_publisher" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Book Stock <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->book_stock }}"
                                                name="book_stock" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Borrow modal -->
                <div class="modal fade" id="borrowModal{{ $item->book_id }}" tabindex="-1"
                    aria-labelledby="borrowModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ url('borrow') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="borrowModalLabel">Borrow Book</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <h3>{{ $item->book_name }}</h3>
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">Member <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Small select example" name="member_id">
                                                @foreach ($member as $memberd)
                                                    <option value="{{ $memberd->member_id }}">{{ $memberd->member_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="" class="form-label">QTY <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" min="1" max="{{ $item->book_stock }}" name="borrow_qty" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $item->book_id }}" name="book_id">
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Borrow</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>

    </table>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
