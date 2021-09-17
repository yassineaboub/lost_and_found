@extends('layouts.body')
@section('content')
<!-- Header -->
<div class="jumbotron">
    <img src="https://faceofsot2021.com/wp-content/uploads/2017/11/sot-mosaic0001.jpg" alt="" class="jumbotron-image">
    <div class="headertext">
        <h1>Users List</h1>
        <p>Manage the users of your application</p>
    </div>

</div>


<!-- Services -->
<div class="update-user">
    <div class="container">
        <div class=".col-xs-4 .col-md-offset-2">
            <div class="panel panel-default panel-info Profile">
                <div class="panel-heading"><h4>My Profile</h4></div>
                <div class="panel-body">
                    <div class="form-horizontal">
                            @if (session('danger'))
                            <div class="alert alert-danger">
                              {{ session('danger') }}
                               </div>
                               @endif
                                 @if (session('success'))
                            <div class="alert alert-success">
                              {{ session('success') }}
                               </div>
                               @endif
                        <form method="POST" action="{{ url('update-user') }}" enctype="multipart/form-data">
                            @csrf
                            @foreach($user as $use)
                            <div class="row">

                                    <div class="container">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload"  name="image" files="true" accept="image/*" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{asset('users/'.$use->image ) }}');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class=" control-label">First Name</label>
                                        <div class="">
                                            <input class="form-control"  value="{{$use->nom}}" type="text" name="nom"
                                                   placeholder="First Name" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Last Name</label>
                                        <div class="">
                                            <input class="form-control" value="{{$use->prenom}}" type="text" name="prenom"
                                                   placeholder="Last Name" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Email</label>
                                        <div class="">
                                            <input class="form-control" value="{{$use->email}}" type="text" name="email"
                                                   placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Adresse</label>
                                        <div class="">
                                            <input class="form-control" value="{{$use->adresse}}" type="text" name="adresse"
                                                   placeholder="Adresse" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">Current password </label>
                                        <div class="">
                                            <input class="form-control" type="password" name="mdp"
                                                   placeholder="Password" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">New password</label>
                                        <div class="">
                                            <input class="form-control" type="password" name="newmdp"
                                                   placeholder="Password" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Re-type new password</label>
                                        <div class="">
                                            <input class="form-control" type="password" 
                                                   placeholder="Password" name="cnfnewmdp" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Phone</label>
                                        <div class="">
                                            <input class="form-control" value="{{$use->tel}}" type="text" name="tel"
                                                   placeholder="xxx-xxx-xxxx" >
                                        </div>
                                    </div></div>
                            </div>
                            @endforeach
                            <div class="form-group">
                                <div style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-xl text-uppercase" >Update</button>
                                </div>
                            </div>
                        </form>
                    </div>  <!-- end form-horizontal -->
                </div> <!-- end panel-body -->

            </div> <!-- end panel -->


        </div> <!-- end size -->
    </div>
</div>
 <!-- end container-fluid -->
@endsection