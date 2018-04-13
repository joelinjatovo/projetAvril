@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
         <!-- Message de notification -->
            @include('includes.notification')
        <!-- fin Message de notification -->
        <h2 class="page-title"><i class="fontello-icon-picture"></i> Paramêtrage Publicité <small>éditer, organiser et visualiser les publicités apparaissant ssur le côté Front-Office du site </small></h2>
        <p class="pagedesc">Cette section vous permettra de modifier les publicités affichant sur le côté Client de votre site.  Elle a été conçue pour faciliter l'intégration des publicités et la gestion de ses contenus.</p>
    </div>
    <!-- // page head -->

    <div id="page-content" class="page-content">
        <div class="navbar navbar-page">
            <div class="navbar-inner">
                <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                        <ul class="nav">
                            @foreach($nomlists as $listes)
                            <li><a href="{{ route('admin.pub.name',$listes->nompage) }}">{{ $listes->nompage }}</a></li>
                            <li class="divider-vertical"></li>
                            @endforeach
                        </ul>
                        <!-- /.nav-collapse --> 
                        <div class="pagination pagination-btn pull-right">
                            <ul class="holder">
                            </ul>
                        </div>
                        <!-- // navigation holder -->
                    </div>
                    <!-- /.nav-collapse --> 
                </div>
            </div>
            <!-- /navbar-inner --> 
        </div>
        <!-- /navbar -->

        <section>
            <div class="row-fluid">
                <div class="span8 well well-nice">

                    @foreach($listsection as $section)

                    <div class="row-fluid">
                        <div class="span6 grider-item">
                            <h4 class="simple-header"><i class="fontello-icon-eye-1"></i> Aperçu : {{ucfirst($section)}}</h4>
                            <div id="previewImage" class="preview-image"> <img src="{{link_img($datas->$section->lienImage)}}"> </div>
                            <table class="table table-light table-condensed">
                                <tr>
                                    <th>Nom du fichier</th>
                                    <td>{{ preg_replace("/assets\/images/",' ',$datas->$section->lienImage) }}</td>
                                </tr>
                                <tr>
                                    <th>Type du Fichier</th>
                                    <td>image - .{{pathinfo($datas->$section->lienImage, PATHINFO_EXTENSION)}}</td>
                                </tr>
                                <tr>
                                    <th>Class en <code>css</code> : </th>
                                    <td>{{ $datas->$section->class }}</td>
                                </tr>
                                <tr>
                                    <th>Dimensions</th>
                                    <td>{{$datas->$section->width}} x {{$datas->$section->height}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="span6 grider-item">

                                <h4 class="simple-header"><a href="#stack-{{$section}}" class="btn btn-yellow pull-right" data-toggle="modal">Uploader une nouvelle</a><i class="fontello-icon-edit"></i> Modification rapide </h4>

                                <!-- // sample modal - resposive ====================  -->
                                <div id="stack-{{$section}}" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fontello-icon-cancel-1"></i></button>
                                        <h4>Ajout d'une nouvelle publicité</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('add.pub') }}" enctype="multipart/form-data" 
                    data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
                                            {{ csrf_field() }}
                                            <h4 class="simple-header"> Image d'illustration de la publicité <small>Taille standard</small> </h4>
                                            <div class="well well-black inline">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 120px;"> <img src="http://www.placehold.it/200x120/EFEFEF/AAAAAA&text=no+image" /> </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div> <span class="btn btn-file"> <span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                                                         <input type="file" name="file" id="file">
                                                        </span> <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                                </div>
                                                <!-- // image upload --> 
                                                <input type="hidden" name="section"  value="{{$section}}">
                                                <input type="hidden" name="page" value="{{$nom_page}}">
                                                <h6>Class Image : <code>width</code></h6>
                                                 <div class="controls"><p><input type="text" class="input-block-level" name="width" value="800" /></p></div>
                                                <h6>Dimension Image : <code>height</code></h6>
                                                 <div class="controls"><p><input type="text" class="input-block-level" name="height" value="451" required="required" /></p></div>
                                                <h6>Description Image : <code>alt</code> ( * Champs Obligatoire )</h6>
                                                 <div class="controls"><p><textarea type="text" class="input-block-level" name="description" /></p></div>
                                                <h6>Class Image : <code>class</code></h6>
                                                 <div class="controls"><p><input type="text" class="input-block-level" name="class" value="..." /></p></div>
                                                 <label class="checkbox pull-left"><input id="remember" class="checkbox" type="checkbox" name="appliquer">Appliquer cette nouvelle publicité sur cette espace pub </label><br>
                                            </div>
                                            <div class="modal-footer"> 
                                                <button data-dismiss="modal" class="btn btn-boo">Annuler</button> 
                                                <button type="submit" class="btn btn-green">Ajouter la publicité</button> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- // sample modal - stack ========================  -->

                                <form id="formNextAccountSettings" class="form-horizontal form-condensed label-left no-margin-bootom" method="post" action="{{ route('update.pub') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="section" value="{{$section}}">
                                    <input type="hidden" name="page" value="{{$nom_page}}">
                                    <input type="hidden" name="nameImage" value="{{$datas->$section->lienImage}}">
                                <fieldset class="form-dark ">
                                    <ul class="form-list">
                                        <li class="control-group">
                                            <label for="fileTile" class="control-label">Class Image: <code>css</code></label>
                                            <div class="controls">
                                                <input id="fileTile" class="input-block-level" type="text" name="class" value="{{$datas->$section->class}}">
                                            </div>
                                        </li>
                                        <!-- // form item -->

                                        <li class="control-group">
                                            <label for="fileAltText" class="control-label">Dimension: <code>width</code></label>
                                            <div class="controls">
                                                <input id="fileAltText" class="input-block-level" type="text" name="width" value="{{$datas->$section->width}}">
                                            </div>
                                        </li>
                                        <!-- // form item -->

                                        <li class="control-group">
                                            <label for="fileCaption" class="control-label">Dimension: <code>height</code></label>
                                            <div class="controls">
                                                <input id="fileCaption" class="input-block-level" type="text" name="height" value="{{$datas->$section->height}}">
                                            </div>
                                        </li>
                                        <!-- // form item -->

                                        <li class="control-group">
                                            <label for="fileDescript" class="control-label">Image Description: <code>alt</code></label>
                                            <div class="controls">
                                                <textarea id="fileDescript" class="input-block-level auto" rows="3" placeholder="Enter text ..." name="description" required="required">{{$datas->$section->description}}</textarea>
                                            </div>
                                        </li>
                                        <!-- // form item -->

                                        <li class="control-group">
                                            <label for="fileToGallery" class="control-label">Publicité(s) Archivée(s)</label>
                                            <div class="controls">
                                                <select id="fileToGallery" class="selectpicker input-medium" data-style="btn-info"  name="archives">
                                                    <option>Parcourir...</option>
                                                    @foreach($archives as $arch)
                                                    <option value="{{$arch->id}}">{{ucfirst($arch->description)}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </li>
                                        <!-- // form item -->

                                    </ul>
                                </fieldset>

                                <!-- // fieldset Input -->

                                <div class="form-actions no-margin-bootom">
                                    <button type="submit" class="btn btn-green">Save data</button>
                                    <button class="btn cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach

                </div>
                <div class="span4">
                    <div class="gallery-well">
                        <h4 class="simple-header"><span class="pull-right">
                            <select id="selectGall" class="selectpicker">
                                <option>Select gallery</option>
                                <option>Gallery 01</option>
                                <option>Gallery 02</option>
                                <option>Gallery 03</option>
                                <option>Gallery 04</option>
                                <option>Gallery 05</option>
                                <option>Gallery 06</option>
                                <option>Gallery 07</option>
                                <option>Gallery 08</option>
                                <option>Gallery 09</option>
                                <option>Gallery 10</option>
                            </select>
                            </span> <i class="fontello-icon-picture"></i> Galerie des publicités : </h4>
                        <div class="scrollBox" style="height:740px; padding-right: 10px"> 

                            <!-- class for thumbnail size - square75 square100 square150 square200 square260 
                                                            horizontal75 horizontal100 horizontal150 horizontal200 horizontal260 
                                                            vertical75 vertical100 vertical150 vertical200 vertical260 -->
                            <ul id="gallery3" class="gallery media-list horizontal100" data-slideshow="3000" data-toggle="modal-gallery" data-target="#modal-gallery">

                                @foreach($archives as $archiv)

                                <!-- Reposition the block .thumbnail-action and add div.clearfix  -->
                                <li class="thumbnail media">
                                    <div class="pull-left">
                                        <div class="nailthumb-container show-loading"> <img class="thumb media-object" src="{{link_img('images/' . $archiv->urlimage1)}}" width="100" height="100"> </div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="{{link_img('images/'.$archiv->urlimage1)}}" target="_blank" class="edit">{{ucfirst($archiv->description)}}</a></h4>
                                        <p><b>Nom de l'image : </b> {{ $archiv->urlimage1 }}</p>
                                        <p><b>Dimension Image : </b> {{ $archiv->width }} x {{$archiv->height}}</p>
                                        <p><b>Class Image : </b> {{ $archiv->class }}</p>

                                    </div>
                                    <div class="clearfix margin-0s"></div>
                                    <div class="thumbnail-action"> 
                                        <span class="data-icon"> 
                                            <span class="fontello-icon-eye-1">56</span> <span class="fontello-icon-heart">14</span> 
                                        </span> 
                                        <span class="menu-icon"> 
                                            <a href="assets/img/demo/gallery/gall_01/image_01.jpg" class="btn-glyph edit fontello-icon-edit"></a>  
                                            <a href="assets/img/demo/gallery/gall_01/image_01.jpg" class="btn-glyph delete fontello-icon-trash-4" data-toggle="modal" data-target="#myModal"></a>
                                            <!-- Modal -->
                                                <div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Confirmation de suppression</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <p>Voulez-vous vraiment supprimer définitivement cette publicité ? <sbr><b><code>Attention:</code> Si cette publicité est active, la suppression de celle-ci supprimera celle qui sont dans vos espaces.</b></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <a href="#" type="button" class="btn btn-danger" data-dismiss="modal">Supprimer</a>
                                                        <button type="reset" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            <!-- end Modal responsive Trash --> 
                                        </span>
                                    </div>
                                </li>
                                <!-- // gallery item -->

                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Example row --> 

        </section>
    </div>
    <!-- // page content --> 

</div>
<!-- // main-content --> 
@endsection