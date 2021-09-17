@extends('layouts.adminbody')
@section('content')

<!-- Header -->
<div class="jumbotron">
    <img src="https://faceofsot2021.com/wp-content/uploads/2017/11/sot-mosaic0001.jpg" alt="" class="jumbotron-image">
    <div class="headertext">
        <h1>Users List</h1>
        <p>Manage the users of your application</p>
    </div>

</div>


<section class=" page-section" id="portfolio">
    <div class="container">
        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Télephone</th>
                <th>Creation date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
             @foreach($user as $use)
            <tr>
                <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1hHnZJCLkgjd4d-HvXfNpVjlg4zyTso-y2wSCsSEoWPksLOmd" alt=""> </td>
                <td>{{$use->nom}} </td>
                <td >{{$use->prenom}}</td>
                <td>{{$use->email}}</td>
                <td>{{$use->tel}}</td>
                <td>{{$use->created_at}}</td>
                <td style="display: flex;"><a href="#" class="btn btn-warning mr-2">Modifier</a>
                    <form action="{{ route('utilisateur.destroy',$use->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>

                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection