@extends('layouts.body')
@section('content')


<!-- Header -->
<div class="object-detail">
    <div class="containerfluid">
        <div class="banner">
            <div id="new"></div>
            <h2 style="position: absolute;z-index: 1000;top: 85%;color: red;left: 9%;"> S il vous plaît entrer la
                position </h2>
        </div>
    </div>
    <!-- Services -->
    <div class="update-user">

        <div class="container">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(!(empty($update_ann)))
            <div class=".col-xs-4 .col-md-offset-2">
                <div class="panel-body">
                    <div class="form-horizontal">
                        @foreach ($update_ann as $update )
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('annonce.update',$update->id_annonce) }}">
                            @csrf
                            @method('PUT')
                            <h2>Date de perdu</h2>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">Titre </label>
                                        <input type="text" value="{{$update->nom}}" class="form-control" name="nom" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFileLang"
                                                name="image" value="{{$update->image}}"  files="true" accept="image/*">
                                            <label class="custom-file-label" for="customFileLang">ajouter une
                                                image</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=" control-label">Description </label>
                                        <textarea class="form-control" placeholder="saisie descrition"
                                            name="desc">{{$update->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{$update->lattitude}}" name="lat" class="lat">
                            <input type="hidden" value="{{$update->longitude}}" name="lng" class="lng">
                            <input type="hidden" value="{{$update->ville}}" name="ville" class="ville">
                            <input type="hidden" value="{{$update->ville}}" name="region" class="region">
                            <input type="hidden" name="etat" class="etat" value="perdu">
                            <div class="form-group">
                                <div style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-xl text-uppercase">save
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div> <!-- end form-horizontal -->
                </div> <!-- end panel-body -->

            </div> <!-- end panel -->
            @else
            <div class=".col-xs-4 .col-md-offset-2">
                <div class="panel-body">
                    <div class="form-horizontal">
                        <form method="POST" enctype="multipart/form-data" action="{{ url('ajfound') }}">
                            @csrf
                            <h2>Date de perdu</h2>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">De </label>
                                        <div class="">
                                            <input class="form-control" type="date" name="date" placeholder="Date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">Jusqu a </label>
                                        <div class="">
                                            <input class="form-control" type="date" name="datefin" placeholder="Date">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">categorie </label>
                                        <div class="">
                                            <select class="form-control object-cat">
                                                <option>please choose</option>
                                                @foreach($category as $cat)
                                                <option data-id="{{$cat->id_cat}}" value="{{$cat->id_cat}}">
                                                    {{$cat->nom_category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">sous categorie </label>
                                        <div class="">
                                            <select class="form-control object-sub-cat" name="obj">
                                                <option>please choose</option>
                                                @foreach($object as $ob)
                                                <option data-parent="{{$ob->id_category}}" data-id="{{$ob->id_objet}}"
                                                    value="{{$ob->id_objet}}">{{$ob->nom_objet}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">Titre </label>
                                        <input type="text" class="form-control" name="nom" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label">image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFileLang"
                                                name="image" files="true" accept="image/*">
                                            <label class="custom-file-label" for="customFileLang">ajouter une
                                                image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=" control-label">Description </label>
                                        <textarea class="form-control" placeholder="saisie descrition"
                                            name="desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="lat" class="lat">
                            <input type="hidden" name="lng" class="lng">
                            <input type="hidden" name="ville" class="ville">
                            <input type="hidden" name="region" class="region">
                            <input type="hidden" name="etat" class="etat" value="perdu">
                            <div class="form-group">
                                <div style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-xl text-uppercase">save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end form-horizontal -->
                </div> <!-- end panel-body -->

            </div> <!-- end panel -->
            @endif




        </div> <!-- end size -->
    </div>
</div>
<!-- end container-fluid -->


<section class="page-section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" type="text" placeholder="Your Name *"
                                    required="required" data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" placeholder="Your Email *"
                                    required="required"
                                    data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *"
                                    required="required"
                                    data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" id="message" placeholder="Your Message *"
                                    required="required"
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->

@endsection