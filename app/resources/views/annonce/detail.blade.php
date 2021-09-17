@extends('layouts.body')
@section('content')
<!-- Header -->
<div class="object-detail">
    <div class="containerfluid">
        <div class="banner">
            <div id="mapdetail"></div>
            <div class="banner-title">
                @foreach ($ann as $annonce )
                <h1>{{$annonce->nom}}</h1>
                @endforeach
            </div>
            <div class="profile-container" style="">

                @foreach ($ann as $annonce )
                <div class="profile-image overflow-centered">
                    <img src="{{asset($annonce->image ) }}" class="fit" alt="Avatar" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
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
        @if (($hideann) == 0 )
        @if ($hidesignal == 0 )

        <button class="btn btn-danger signaler" style="position: absolute; right: 10%;"><i
                class="fa fa-exclamation-triangle"></i> Signaler
        </button>
        <div class="signaler-form">
            @foreach ($ann as $annonce )
            <form action="{{ url('addsignal') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Cause:</label>
                    <select name="cause" class="form-control">
                        <option value="Annonce de contenus inappropriés">Annonce de contenus inappropriés
                        </option>
                        <option value="Fausse information">Fausse information</option>
                        <option value="Ventes interdites">Ventes interdites</option>
                        <option value="Harcèlement">Harcèlement</option>
                        <option value="Violence">Violence</option>
                        <option value="Contenu indésirable">Contenu indésirable</option>
                    </select>
                </div>

                <input type="text" hidden name="id_ann" value="{{$annonce->id_annonce}}">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-danger">Signaler</button>
                </div>

            </form>
            @endforeach
        </div>
        @endif
        @endif
        <div class="row">
            @foreach ($ann as $annonce )
            <div class="content offset-md-1 col-md-10 row" style="font-size: 16px">
                <div class="col-md-5">
                    <strong>date:</strong> {{$annonce->dateaction}}<br>
                    <strong>etat:</strong> {{$annonce->etat}} <br>

                </div>
                <div class="col-md-5">
                    <strong>date creation:</strong> {{$annonce->created_at}} <br>
                    <strong>Ville</strong> {{$annonce->ville}}

                </div>
                <div class="col-md-12">
                    <strong>
                        description
                    </strong><br>
                    {{$annonce->description}}
                </div>
                @endforeach
                @if (($hideann) > 0)

                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>phone number</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($correctanswer as $correct )
                        <tr>
                            <td><img src="{{asset('users/user.svg') }}">
                            </td>
                            <td>{{$correct->nom}}</td>
                            <td>{{$correct->prenom}}</td>
                            <td><a href="tel:{{$correct->tel}}">{{$correct->tel}}</a></td>
                            <td>
                                <a href="mailto:{{$correct->email}}">{{$correct->email}}</a>
                            </td>
                        </tr>
                        @endforeach


                        </tr>


                    </tbody>
                </table>
                @endif
                @if (($hideann) == 0)
                <div class="stepper col-md-12 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>


                    <form id="regiration_form" action="{{ url('save_answer') }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <input type="text" name="idannonce" value="{{$id_annonce}}" hidden>
                        @for ($i =0; $i <= 2; $i++) <fieldset>
                            @for ($j=0; $j < sizeof($question[$i]); $j++) <h2>Question {{$i+1}}:
                                {{$question[$i][$j]->question }}?</h2>
                                <input name="quetion{{$i}}" hidden value="{{$question[$i][$j]->id_quest }}">
                                @endfor
                                <select name="reponse{{$i}}" id="repon{{$i}}" class="form-control ">
                                    @for($j=0; $j < count($reponse[$i]); $j++) <option
                                        value="{{$reponse[$i][$j]->id_rep}}">{{$reponse[$i][$j]->reponse}}</option>
                                        @endfor
                                </select>


                                @if (($i+1) > 1)
                                <input type="button" name="previous" class="previous btn btn-warning"
                                    value="Previous" />
                                @endif
                                @if (($i+1)
                                <= 2) <input type="button" name="next" class="next btn btn-info" value="Next" />
                                @endif
                                @if (($i+1) == 3)
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                                @endif
                                </fieldset>
                                @endfor
                    </form>

                </div>
                @endif
            </div>

        </div>

    </div>
</div>
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
@endsection