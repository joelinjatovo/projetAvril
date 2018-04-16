@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> Gestion de Blog <small>Ajout d'un article dans Blog </small></h2>
        <div class="page-bar">
            <div class="btn-toolbar"> </div>
        </div>
    </div>
    <!-- // page head -->
    <div id="page-content" class="page-content">
        <form method="post" action="{{$action}}" enctype="multipart/form-data" 
                    data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section>
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i> Titre <small>Ajouter un nouveau titre</small></h3>
                </div>
                    <div class="well well-nice form-dark">
                        <div class="control-group">
                            <textarea id="wysiBooEditorBlack" class="input-block-level" style="height: 100px" name="title" placeholder="Ajouter un nouveau titre">{{$item->title}}</textarea>
                        </div>
                    </div>
                    <div class="page-header">
                        <h3><i class="fontello-icon-article-alt opaci35"></i> Gestion des contenus <small>Ajouter un paragraphe</small></h3>
                    </div>
                    <div class="row-fluid">
                            <div class="well well-nice">
                                <h4 class="simple-header">Paragraphe <small>Ajouter un nouveau paragraphe</small></h4>
                                <div class="control-group">
                                    <textarea id="wysiBooEditor" class="input-block-level" style="height: 560px" name="content" placeholder="Enter text ...">{{$item->content}}</textarea>
                                </div>
                            </div>
                    </div>
            </section>

            <section>

                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i> Gestion des mots-clés <small>Ajouter des mots-clés</small></h3>
                </div>

                <div class="row-fluid">
                        <div class="well well-nice">
                            <ul class="inline">
                                <li class="listbox-left span5">
                                    <h4 class="simple-header">
                                        <button id="box5Clear" class="btn btn-small btn-yellow pull-right" type="button"><i class="fontello-icon-filter"></i> Reinit.</button>
                                        Listes des mots-clés</h4>
                                    <input id="box5Filter" class="input-block-level" type="text">
                                    <select id="box5View" multiple="multiple" class="input-block-level" style="height:210px">
                                        <option value="501649">Immobilier</option>
                                        <option value="501497">Immeuble</option>
                                        <option value="501053">Location</option>
                                        <option value="500001">Australie</option>
                                        <option value="501227">Maison luxueuse</option>
                                        <option value="501610">Villa</option>
                                        <option value="501514">Appartement</option>
                                        <option value="501656">Terrain à vendre</option>
                                        <option value="501050">Piscine</option>
                                        <option value="501075">Garage</option>
                                        <option value="501493">Salle de bain</option>
                                        <option value="501562">Cuisine</option>
                                        <option value="500676">Range</option>
                                        <option value="501460">Achats</option>
                                        <option value="500004">Vente</option>
                                        <option value="500336">Conseil placement</option>
                                    </select>
                                    <span id="box5Counter" class="countLabel"></span>
                                    <select id="box5Storage">
                                    </select>
                                </li>
                                <li class="listbox-control span2 text-center">
                                    <h4 class="simple-header">Actions</h4>
                                    <ul class="listbox-menu well well-nice">
                                        <li>
                                            <button id="to6" class="btn btn-block" type="button"><i class="fontello-icon-to-end-1"></i></button>
                                        </li>
                                        <li>
                                            <button id="allTo6" class="btn btn-block" type="button"><i class="fontello-icon-to-end-alt"></i></button>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <button id="allTo5" class="btn btn-block" type="button"><i class="fontello-icon-to-start-alt"></i></button>
                                        </li>
                                        <li>
                                            <button id="to5" class="btn btn-block" type="button"><i class="fontello-icon-to-start-1"></i></button>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <button class="btn btn-green btn-block" type="submit">Valider les mots-clés</button>
                                        </li>
                                    </ul>
                                </li>
                                <li class="listbox-right span5">
                                    <h4 class="simple-header">
                                        <button id="box6Clear" class="btn btn-small btn-yellow pull-right" type="button"><i class="fontello-icon-filter"></i> Reinit.</button>
                                        <i class="fontello-icon-list-4"></i> Mots-clés selectionnés </h4>
                                    <input id="box6Filter" class="input-block-level" type="text">
                                    <select id="box6View" multiple="multiple" class="input-block-level" style="height:210px">
                                    </select>
                                    <span id="box6Counter" class="countLabel"></span>
                                    <select id="box6Storage">
                                    </select>
                                </li>
                            </ul>
                        </div>
                </div>
            </section>

            <section>
                <div class="page-header">
                    <h3><i class="fontello-icon-monitor opaci35"></i> Chargement des fichiers <small>Uploder plusieurs fichiers</small></h3>
                </div>
                <div class="row-fluid margin-bottom30">
                    <div class="span5">
                        <div class="row-fluid margin-bottom20">
                            <div class="span6">
                                <div class="well well-nice inline">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                            <img src="{{storage($item->image)}}">
                                        </div>
                                        <div> <span class="btn btn-file"> <span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                                            <input type="file" name="image" id="file">
                                            </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions no-margin-bootom">
                    <button type="submit" class="btn btn-green">Tout sauvegarder</button>
                    <button class="btn cancel" type="reset">Tout annuler</button>
                    <a href="javascript:history.back()" class="btn btn-green pull-right" type="submit">Retour page précedent</a>
                </div> 
            </section>
            
        </form>
        <!-- // form --> 

    </div>
    <!-- // page content --> 

</div>
<!-- // main-content --> 
@endsection
