@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.alerts')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> @lang('app.admin.product.gestion') <small>@if($item->id>0) @lang('app.admin.product.update') else @lang('app.admin.product.add') @endif</small></h2>
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
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i>Prix du produit</h3>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <h4 class="simple-header">Ajouter <small>un prix de produit</small></h4>
                        <div class="control-group">
                            <textarea id="wysiBooEditor" class="input-block-level" style="height: 560px" name="price" placeholder="Prix du produit ...">{{$item->price}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i>Taux de mise en vente</h3>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <h4 class="simple-header">Ajouter <small>le taux de mise en vente</small></h4>
                        <div class="control-group">
                            <textarea id="wysiBooEditor" class="input-block-level" style="height: 560px" name="tma" placeholder="Taux de mise en vente ...">{{$item->tma}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i>Categories</h3>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <h4 class="simple-header">Selectionner les <small>categories</small></h4>
                        <div class="control-group">
                            <select multiple name="actegory[]">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <h3><i class="fontello-icon-monitor opaci35"></i> Chargement de fichier</h3>
                </div>
                <div class="row-fluid margin-bottom30">
                    <div class="span5">
                        <div class="row-fluid margin-bottom20">
                            <div class="span6">
                                <div class="well well-nice inline">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 120px;">
                                            <img src="{{$item->imageUrl()}}">
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
            </section>

            <section>
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
