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
                        <form method="post" action="http://localhost/iea/search" class="form-inline">
                            <input type="hidden" name="_token" value="BHFqg7fSe2wdmu9XpbP4VUXXtPDIdwm007pnDXuQ">
                            <button class="btn  toggle-btn" type="button"><i class="fa fa-bars"></i></button>
                             <div class="form-group">
                                <select id="basic" class="selectpicker show-tick form-control" name="etats">
                                    <option value="">Etats</option>
                                    <option value="Australie-Méridionale">Australie-Méridionale </option>
                                    <option value="Gold coast">Gold coast</option>
                                    <option value="Nouvelle-Galles du Sud">Nouvelle-Galles du Sud</option>
                                    <option value="Queensland">Queensland</option>
                                    <option value="Victoria">Victoria</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Villes" name="villes">
                                    <option value="">Villes</option>
                                    <option value="Surfers Paradise">Surfers Paradise</option>
                                    <option value="Melbourne">Melbourne</option>
                                    <option value="Benowa Waters">Benowa Waters</option>
                                    <option value="Valla Beach">Valla Beach</option>
                                    <option value="MacLeay Island">MacLeay Island</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="basic" class="selectpicker show-tick form-control" name="suburbs">
                                    <option value="">Darlington</option>
                                    <option value="">Lucas Heights </option>
                                    <option value="">Mosman</option>
                                    <option value="">Rose Bay</option>
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
                                        <label for="price-range">Prix (AU$):</label>
                                        <input type="text" class="span2" value="" data-slider-min="100000"
                                               data-slider-max="10000000" data-slider-step="50000"
                                               data-slider-value="[500000,5000000]" id="price-range1" name="prix"><br />
                                        <b class="pull-left color">100000$</b>
                                        <b class="pull-right color">10000000$</b>
                                    </div>
                                    <div class="form-group mar-l-20">
                                        <label for="property-geo">Superficie (m2) :</label>
                                        <input type="text" class="span2" value="" data-slider-min="50"
                                               data-slider-max="1000" data-slider-step="25"
                                               data-slider-value="[50,450]" id="property-geo" name="superficie"><br />
                                        <b class="pull-left color">50m</b>
                                        <b class="pull-right color">1000m</b>
                                    </div>
                                </div>
                                <div class="search-row">
                                    <div class="form-group mar-r-20">
                                        <label for="price-range">Min salle de bain :</label>
                                        <input type="text" class="span2" value="" data-slider-min="1"
                                               data-slider-max="10" data-slider-step="1"
                                               data-slider-value="[4,8]" id="min-baths" name="sdb"><br />
                                        <b class="pull-left color">1</b>
                                        <b class="pull-right color">10</b>
                                    </div>
                                    <div class="form-group mar-l-20">
                                        <label for="property-geo">Min chambre :</label>
                                        <input type="text" class="span2" value="" data-slider-min="1"
                                               data-slider-max="10" data-slider-step="1"
                                               data-slider-value="[3,7]" id="min-bed" name="ch"><br />
                                        <b class="pull-left color">1</b>
                                        <b class="pull-right color">10</b>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <select id="basic" class="selectpicker show-tick form-control" name="typelogement">
                                        <option value="">Type de logement</option>
                                        <option value="Appartement">Appartement </option>
                                        <option value="Maison individuelle">Maison individuelle</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Terrain">Terrain</option>
                                        <option value="Bureau & Local commercial">Bureau & Local commercial</option>
                                        <option value="Entrepôt & Local d'activité">Entrepôt & Local d'activité</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="basic" class="selectpicker show-tick form-control" name="localisation">
                                        <option value="">Localisation</option>
                                        <option value="">En agglomération </option>
                                        <option value="">Hors agglomération</option>
                                        <option value="">En campagne</option>
                                    </select>
                                </div>
                                <br>
                                <div class="search-row">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox">Suburbs voisins
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox">Salle d'eau
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox">Toilette
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="search-row">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Garage
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Piscine
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Emergency Exit(200)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-row">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Laundry Room(10073)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Jog Path(1503)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 26' Ceilings(1200)
                                            </label>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                </div>
                                <button class="btn search-btn prop-btm-sheaerch" type="submit"><i class="fa fa-search"></i></button>
                            </div><!-- end div residentiel -->

                            <div id="foncier" class="tab-pane fade">
                              <div class="search-row">
                                    <div class="form-group">
                                        <select id="basic" class="selectpicker show-tick form-control" name="typefoncier">
                                            <option value="">Types de Foncier</option>
                                            <option value="foncier agricole">Foncier Agricole </option>
                                            <option value="foncier residentiel">Foncier Résidentiel </option>
                                        </select>
                                    </div><br>
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
