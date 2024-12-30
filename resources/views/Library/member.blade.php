@extends('Layout.layout')

@section('content')
    <h2>Member</h2>
    <hr>

    <form action="{{ url('member') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label">Member name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="member_name" required>
            </div>

            <div class="col-6">
                <label for="" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="member_username" required>
            </div>

            <div class="text-end mt-4">
                <button class="btn btn-primary" type="submit">Create Member</button>
            </div>
        </div>
    </form>

    <hr class="my-5">

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member as $item)
                <tr>
                    <td>{{ $item->member_name }}</td>
                    <td>{{ $item->member_username }}</td>
                    <td class="d-flex align-items-center gap-2">
                        <button class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $item->member_id }}">
                            <i class="fad fa-pen-to-square text-white"></i>
                        </button>
                        <form onsubmit="return confirm('Are you sure to delete this member?')" action="{{ url('member/'.$item->member_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="fad fa-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal edit -->
                <div class="modal fade" id="editModal{{ $item->member_id }}" tabindex="-1"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ url('member/' . $item->member_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Member</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="member_id" value="{{ $item->member_id }}">
                                    <label for="form-label">Member Name</label>
                                    <input type="text" name="member_name" class="form-control mt-2"
                                        value="{{ $item->member_name }}">
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
