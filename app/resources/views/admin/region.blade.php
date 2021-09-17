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
    <div class="center-block">
      
      <h2 class="nom_zone">Ajouter Nouveau categorie :</h2><br>
      <form action="{{ url('ajregion') }}" method="POST" enctype="multipart/form-data">
        @csrf
  <div class="form-group">
          <label class="control-label col-sm-2" >choisir la ville du region :</label>
             <div class="col-sm-10">
                  <select class="custom-select" name="ville">
                     <option selected >choisir ville</option>
                       @foreach($ville as $vil)
                          <option value="{{$vil->id_ville}}">{{$vil->nomville}}</option>
                       @endforeach
                    </select>
            </div>
    </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="nomsection">Nom region:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nomsection" name="nomsection" placeholder="Enter Le nom du region">
          </div>
        </div>

        <div class="form-group">
          <div class="add col-sm-offset-2 col-sm-10">
            <button type="submit" class=" add btn btn-success mr-2"><i class=" fa fa-save icon1"></i>Sauvegarder
            </button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle icon1"></i>Annuler
            </button>
          </div>
        </div>
      </form>
    </div>
    <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Id region</th>
          <th>Nom region</th>
          <th>Nom ville</th>
          <th>Creation date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
  @foreach($region as $reg)
        <tr>
          <td>{{$reg->id_reg }}</td>
          <td>{{$reg->nomreg}}</td>
          <td>{{$reg->idville  }}</td>
          <td>{{$reg->created_at}}</td>
          <td style="display: flex;"><a href="#" class="btn btn-warning mr-2">Modifier</a>
            <form action="{{ route('regions.destroy',$reg->id_reg) }}"  method="POST">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-danger">delete</button></td>         </tr>
 @endforeach
      </tbody>
    </table>
  </div>
</section>

@endsection