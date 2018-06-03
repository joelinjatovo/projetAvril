<div id="slider-area">
    <div class="main-slider">
        <div id="bg-slider" class="owl-carousel owl-theme">
          <div class="slider"><img src="{{asset('images/slider/1.jpg')}}" alt="Slide"></div>
          <div class="slider"><img src="{{asset('images/slider/2.jpg')}}" alt="Slide"></div>
          <div class="slider"><img src="{{asset('images/slider/3.jpg')}}" alt="Slide"></div>
        </div>
        <div class="slider-content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <!-- corps barre de recherche -->
                     <div class="search-form wow pulse" data-wow-delay="0.8s">
                        <form method="post" action="{{route('search')}}" class="form-inline">
                            {{csrf_field()}}
                            <button class="btn toggle-btn" type="button"><i class="fa fa-bars"></i></button>
                             <div class="form-group">
                                <select id="basic" class="form-control" name="state">
                                    <option value="">Etats</option>
                                    @if(isset($states))
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->content}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="basic" class="form-control" name="type">
                                    <option value="">Type</option>
                                    @if(isset($types))
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="basic" class="form-control" name="location_type">
                                    <option value="">Localisation</option>
                                    @if(isset($locationTypes))
                                        @foreach($locationTypes as $locationType)
                                            <option value="{{$locationType->id}}">{{$locationType->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                            <div style="display: none;" class="search-toggle tab-content">
                              <a data-toggle="tab" class="btn btn-default" href="#residentiel"><i class="fa fa-home" aria-hidden="true">&nbsp;Résidentiel</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#foncier"><i class="fa fa-map-o" aria-hidden="true">&nbsp;Foncier</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#industriel"><i class="fa fa-industry" aria-hidden="true">&nbsp;Industriel</i></a>
                              <a data-toggle="tab" class="btn btn-default" href="#commercial"><i class="fa fa-building" aria-hidden="true">&nbsp;Commercial</i></a>
                            <div id="residentiel" class="tab-pane fade in active">
                                <div class="search-row">
                                    <div class="form-group mar-r-20">
                                        <label for="price-range">Prix (AU $):</label>
                                        <input type="text" class="span2" name="price" value="" data-slider-min="100000" data-slider-max="10000000" data-slider-step="50000" data-slider-value="[500000,5000000]" id="price-range1">
                                        <br>
                                        <b class="pull-left color">100000$</b>
                                        <b class="pull-right color">10000000$</b>
                                    </div>
                                    <div class="form-group mar-l-20">
                                        <label for="property-geo">Superficie (m2) :</label>
                                        <input type="text" class="span2"  name="superficie" value="" data-slider-min="50" data-slider-max="1000" data-slider-step="25" data-slider-value="[50,450]" id="property-geo">
                                        <br>
                                        <b class="pull-left color">50m2</b>
                                        <b class="pull-right color">1000m2</b>
                                    </div>
                                </div>
                                <div class="search-row">
                                    <div class="form-group mar-r-20">
                                        <label for="price-range">Min salle de bain :</label>
                                        <input type="text" class="span2" name="bain" value="" data-slider-min="1"
                                               data-slider-max="10" data-slider-step="1"
                                               data-slider-value="[4,8]" id="min-baths" name="sdb"><br />
                                        <b class="pull-left color">1</b>
                                        <b class="pull-right color">10</b>
                                    </div>
                                    <div class="form-group mar-l-20">
                                        <label for="property-geo">Min chambre :</label>
                                        <input type="text" class="span2" name="chambre" value="" data-slider-min="1"
                                               data-slider-max="10" data-slider-step="1"
                                               data-slider-value="[3,7]" id="min-bed" name="ch"><br />
                                        <b class="pull-left color">1</b>
                                        <b class="pull-right color">10</b>
                                    </div>
                                </div>
                                <br>
                                <div class="search-row">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Suburbs voisins
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Salle d'eau
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Toilette
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <button class="btn search-btn prop-btm-sheaerch" type="submit"><i class="fa fa-search"></i></button>
                            </div><!-- end div residentiel -->

                            <div id="foncier" class="tab-pane fade">
                              <div class="search-row">
                                <div class="form-group mar-r-20">
                                    <label for="price-range">Prix (AU$):</label>
                                    <input type="text" class="span2" value="" data-slider-min="100000"
                                           data-slider-max="10000000" data-slider-step="50000"
                                           data-slider-value="[500000,5000000]" id="price-range" name="prix"><br />
                                    <b class="pull-left color">100000$</b>
                                    <b class="pull-right color">10000000$</b>
                                </div>
                                <div class="form-group mar-l-20">
                                    <label for="property-geo">Superficie (m2) :</label>
                                    <input type="text" class="span2" value="" data-slider-min="50"
                                           data-slider-max="1000" data-slider-step="25"
                                           data-slider-value="[50,450]" id="property-geo1" name="superficie"><br />
                                    <b class="pull-left color">50m</b>
                                    <b class="pull-right color">1000m</b>
                                </div>
                                <br>
                              </div><!-- end search-row -->
                            </div><!-- end div foncier -->

                            <div id="industriel" class="tab-pane fade">
                              <h3>Menu Industriel</h3>
                              <p>En attente d'information venant d'Agentpoint</p>
                            </div><!-- end id industriel -->

                             <div id="commercial" class="tab-pane fade">
                              <h3>Menu Commercial</h3>
                              <p>En attente d'information venant d'Agentpoint</p>
                            </div><!-- end id industriel -->

                          </div><!-- end content search-bar -->
                        </form>
                    </div><!-- end barre de recherche -->
                </div>
            </div>
        </div>
    </div>
  </div>
