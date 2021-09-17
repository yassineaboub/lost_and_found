@extends('layouts.adminbody')
@section('content')


<!-- Header -->
<div class="jumbotron">
    <img src="https://faceofsot2021.com/wp-content/uploads/2017/11/sot-mosaic0001.jpg" alt="" class="jumbotron-image">
    <div class="headertext">

    </div>

</div>

<section class=" page-section" id="portfolio">
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2>List annonce signaler :</h2>
        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>titre annonce</th>
                    <th>Description</th>
                    <th>Type </th>
                    <th>Cause</th>
                    <th>Nombre signale</th>
                    <th>Date creation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listsignal as $list )
                <tr>
                    <td>{{$list->id_signale}}</td>
                    <td>{{$list->nom }}</td>
                    <td>{{$list->description}}</td>
                    <td>{{$list->etat }}</td>
                    <td>{{$list->cause}}</td>
                    <td>{{$list->nb_signal }}</td>
                    <td>{{$list->created_at}}</td>
                    <td style="display: flex;"><a href="{{ url('/details/'.$list->id_ann)}}" class="btn btn-info mr-2">consulter</a>
                        <form action="{{route ('signaler.destroy',$list->id_signale)}}" method="POST">
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