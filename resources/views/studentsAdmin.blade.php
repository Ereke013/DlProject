@extends('layout.admin')


@section('title-block')
    Student
@endsection

@section('content')
    <div class="row mt-3 text-center">
        <h1 style="margin-left: auto;margin-right: auto">Students</h1>
    </div>
    <div class="row mt-2 text-center">
        <button type="button" class="btn btn-primary" style="" data-toggle="modal"
                data-target="#staticBackdrop">
            +ADD NEW
        </button>
    </div>
    <div class="row mt-4">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>FULL NAME</th>
                    <th>BIRTHDAY</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>GROUP NAME</th>
                    <th>DETAILS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $std)
                    <tr>
                        <td>{{$std->id}}</td>
                        <td>{{ \App\Models\User::find($std->userId)->name }}</td>
                        <td>{{$std->bday}}</td>
                        <td>{{ \App\Models\User::find($std->userId)->email }}</td>
                        <td>{{ \App\Models\User::find($std->userId)->utype=='STU'?'Student':'Teacher'}}</td>
                        <td>{{\App\Models\Groups::find($std->groupId)->group_name}}</td>
                        <td><a href="{{route('students-details', $std->id)}}" class="btn btn-info btn-sm">DETAILS</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{route('student-form')}}" method="post">
        @csrf
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">New Teacher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label>User:</label>
                                <select class="form-control" name="userId">
                                    @foreach($users as $us)
                                        <option value="{{$us->id}}">{{$us->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label>Birthday:</label>
                            <input type="date" name="bday" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number:</label>
                            <input type="text" name="phoneNumber" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Speciality:</label>
                            <input type="text" name="speciality" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Group:</label>
                            <select class="form-control" name="groupId">
                                @foreach($dataGroups as $gr)
                                    <option value="{{$gr->id}}">{{$gr->group_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection
