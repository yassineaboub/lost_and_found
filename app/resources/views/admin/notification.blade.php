@extends('layouts.adminbody')
@section('content')

<!-- Header -->
<div class="jumbotron">
    <img src="https://www.obsnumerique.org/wp-content/uploads/2018/09/Alert-Obnh.jpg" alt="" style="width: 100%;height: 100%;">
    <div class="headertext">
        <h1 style="color: #000000;">Les Annonces signalées</h1>
        <p>Supprimer les Annonce signalées</p>
    </div>

</div>


<section class=" page-section" id="portfolio">
    <div class="container">
        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Nom D'utilisateur</th>
                <th>Nom D'annonce</th>
                <th>Cause</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
             @foreach($signals as $sig)
            <tr>
                <td>{{$sig->nom}} {{$sig->prenom}}</td>
                <td >{{$sig->nomA}}</td>
                <td>{{$sig->cause}}</td>
                <td><a href="{{ url('/details/'.$sig->id_ann )}}"  target="_blank" class="btn btn-warning mr-2">Consulter</a></td>
                <td>
                    <form action="{{ route('annonce.destroy',$sig->id_ann) }}" method="POST">
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