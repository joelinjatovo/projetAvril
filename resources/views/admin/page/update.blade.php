@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title"><i class="aweso-icon-list-alt"></i> Gestion de pages <small>Ajout d'une page</small></h2>
        <div class="page-bar">
            <div class="btn-toolbar"> </div>
        </div>
    </div>
    <!-- // page head -->
    @include('includes.notification')
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
                        <textarea id="wysiBooEditorBlack" class="input-block-level" style="height: 50px" name="title" placeholder="Ajouter un nouveau titre">{{$item->title}}</textarea>
                    </div>
                </div>
                <div class="well well-nice form-dark">
                    <div class="control-group">
                        <textarea id="wysiBooEditorBlack" class="input-block-level" style="height: 50px" name="path" placeholder="Ajouter un path">{{$item->path}}</textarea>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <h4 class="simple-header">Contenu de la page </h4>
                        <div class="control-group">
                            <textarea id="wysiBooEditor" class="input-block-level" style="height: 300px" name="content" placeholder="Enter text ...">{{$item->content}}</textarea>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i> Page parent</h3>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <select name="parent_id" style="width:100%;">
                            <option>@lang('app.select_one')</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{$page->id==$item->parent_id?'selected':''}}>{{$page->title}} ({{$page->path}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>
            <section>
                <div class="page-header">
                    <h3><i class="fontello-icon-article-alt opaci35"></i> Ordre de la page</h3>
                </div>
                <div class="row-fluid">
                    <div class="well well-nice">
                        <input type="number" min="0" name="page_order" placeholder="Ordre de la page" style="width:100%;">
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
