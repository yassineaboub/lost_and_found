@extends('layouts.body')
@section('content')
    <!-- Header -->
    <div class="jumbotron">
        <img src="https://faceofsot2021.com/wp-content/uploads/2017/11/sot-mosaic0001.jpg" alt=""
             class="jumbotron-image">
        <div class="headertext">
            <h1>Users List</h1>
            <p>Manage the users of your application</p>
        </div>

    </div>

    <section class=" page-section" id="portfolio">
        <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
            <h2>Liste annonce :</h2>
            <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Date de creation</th>
                    <th>etat</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ann as $annon)
                    <tr>
                        <td>{{$annon->nom}} </td>
                        <td>{{$annon->description}}</td>
                        <td>{{$annon->created_at}}</td>
                        <td>{{$annon->etat}}</td>
                        <td>
                        <a href="{{ route('annonce.edit',$annon->id_annonce) }}" class="btn btn-warning mr-2">Modifier</a>
                        </td>
                        <td>
                        <form action="{{ route('annonce.destroy',$annon->id_annonce) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                        </>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection