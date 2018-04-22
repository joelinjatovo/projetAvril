@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    @include('includes.notification')
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> Gestion de pages <small>Ajout d'une page</small></h2>
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
                    <h3><i class="fontello-icon-article-alt opaci35"></i> Titre <small>Ajouter un nouveau page</small></h3>
                </div>
                <div class="well well-nice form-dark">
                    <div class="control-group">
                        <textarea id="wysiBooEditorBlack" class="input-block-level" style="height: 100px" name="title" placeholder="Ajouter un nouveau titre">{{$item->title}}</textarea>
                    </div>
                </div>
                <div class="well well-nice form-dark">
                    <div class="control-group">
                        <textarea id="wysiBooEditorBlack" class="input-block-level" style="height: 100px" name="path" placeholder="Ajouter un path">{{$item->path}}</textarea>
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