@extends('Layout.layout')

@section('content')
    <div class="d-flex justify-content-between">
        <h2>Borrow</h2>
    </div>
    <hr>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Borrow ID</th>
                <th>Book ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Book Name</th>
                <th>Borrow QTY</th>
                <th>Borrow Date</th>
                <th>Borrow Return</th>
                <th>Borrow Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrow as $item)
                <tr>
                    <td>{{ $item->borrow_id }}</td>
                    <td>{{ $item->book_id }}</td>
                    <td>{{ $item->member_id }}</td>
                    <td>{{ $item->member_name }}</td>
                    <td>{{ $item->book_name }}</td>
                    <td>{{ $item->borrow_qty }}</td>
                    <td>{{ $item->borrow_date }}</td>
                    <td>{{ $item->borrow_return }}</td>
                    <td>
                        @if ($item->borrow_status == 1)
                            <span class="text-warning">Borrowed</span>
                        @elseif ($item->borrow_status == 2)
                            <span class="text-success">Returned</span>
                        @endif
                    </td>
                    <td class="d-flex align-items-center gap-2">
                        @if ($item->borrow_status == 1)
                            <button class="btn btn-warning text-white" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->borrow_id }}">
                                Return
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal edit -->
                <div class="modal fade" id="editModal{{ $item->borrow_id }}" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ url('borrow/' . $item->borrow_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Return Book</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to return this book right now?
                                </div>
                                <input type="hidden" value="{{ $item->book_id }}" name="book_id">
                                <input type="hidden" value="{{ $item->borrow_qty }}" name="borrow_qty">
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning text-white">Return</button>
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
