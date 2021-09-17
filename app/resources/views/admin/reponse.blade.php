@extends('layouts.adminbody')
@section('content')

<!-- Header -->
<div class="jumbotron">
    <img src="https://faceofsot2021.com/wp-content/uploads/2017/11/sot-mosaic0001.jpg" alt="" class="jumbotron-image">
    <div class="headertext">
        <h1>Reponse List</h1>
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
        @if(!(empty($reponse_update)))
        <div class="center-block">

            <h2 class="nom_zone">Update reponse :</h2><br>
            @foreach ($reponse_update as $update )
            <form action="{{ route('reponses.update',$update->id_rep) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="control-label col-sm-2">choisir question :</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class=" control-label">Question </label>
                            <div class="">
                                <select class="form-control " name="quetion">
                                    <option>please choose</option>
                                    @foreach($question as $quest)
                                    <option value="{{$quest->id_quest}}"
                                        {{ ( $update->id_que == $quest->id_quest) ? 'selected' : '' }}>
                                        {{$quest->question}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="rep">Saisie reponse :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rep" name="rep" value="{{$update->reponse}}"
                            placeholder="Enter Le question">
                    </div>
                </div>

                <div class="form-group">
                    <div class="add col-sm-offset-2 col-sm-10">
                        <button type="submit" class=" add btn btn-success mr-2"><i
                                class=" fa fa-save icon1"></i>Sauvegarder
                        </button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle icon1"></i>Annuler
                        </button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>

        @else
        <div class="center-block">

            <h2 class="nom_zone">Ajouter Nouveau Reponse :</h2><br>
            <form action="{{ url('ajrep') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-2">choisir question :</label>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class=" control-label">Question </label>
                            <div class="">
                                <select class="form-control " name="quetion">
                                    <option>please choose</option>
                                    @foreach($question as $quest)
                                    <option value="{{$quest->id_quest}}">{{$quest->question}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="rep">Saisie reponse :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rep" name="rep" placeholder="Enter Le question">
                    </div>
                </div>

                <div class="form-group">
                    <div class="add col-sm-offset-2 col-sm-10">
                        <button type="submit" class=" add btn btn-success mr-2"><i
                                class=" fa fa-save icon1"></i>Sauvegarder
                        </button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle icon1"></i>Annuler
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endif

        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Id Reponse</th>
                    <th>Reponse</th>
                    <th>Qeuestion</th>
                    <th>Date creation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reponses as $reponse)
                <tr>
                    <td>{{$reponse->id_rep}}</td>
                    <td>{{$reponse->reponse}}</td>
                    <td>{{$reponse->question}}</td>
                    <td>{{$reponse->created_at}}</td>
                    <td style="display: flex;"><a href="{{ route('reponses.edit',$reponse->id_rep) }}"
                            class="btn btn-warning mr-2">Modifier</a>
                        <form action="{{ route('reponses.destroy',$reponse->id_rep) }}" method="POST">
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