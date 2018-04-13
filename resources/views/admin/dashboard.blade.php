@extends('layouts.admin')

@section('content')
<div class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>Tableau de bord</h3>
            </div>
            <div>
                <h4>Statistique sur le produit</h4>
                <legend>
                    <select id="lstTypeGraphe">
                        <option> --Produit à étudier-- </option>
                        <option value="ProduitVendre"> Les produits à vendre </option>
                        <option value="ProduitCoursVente"> Les produits en cours de vente </option>
                        <option value="ProduitVendus"> Les produits vendus </option>
                    </select>
                    <a class="btn btn-success" href="#">Voir graphe</a>
                </legend>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par Etats</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartLocation" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par prix</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartPrix" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par type</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartTypeProduit" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des produits par vendeur</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartTypeVendeur" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h4>Statistique sur les membres enregistrés</h4>
                <legend></legend>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres par pays</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientPays" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres par date</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientDate" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
              <div class="span6 widget well well-simple">
                  <div class="widget-header">
                      <h4><i class="fontello-icon-chart"></i>Repartition des membres cumulé</h4>
                  </div>
                  <div class="widget-content">
                      <div class="widget-body">
                          <div id="chartClientCumule" style="width: 100%; height: 300px;"></div>
                      </div>
                  </div>
              </div>
            </div>

            <div>
                <h4>Statistiques sur les Membres acheteurs</h4>
                <legend></legend>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs par Pays</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                          <div id="chartClientAcheteurPays" style="width: 100%; height: 300px;"></div>

                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs par date d'achat</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientAcheteurDate" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs par type de bien</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientAcheteurTypeBien" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs par localisation du bien</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientAcheteurLocalisationBien" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs par montant d'achat</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientAcheteurMontantAchat" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des membres acheteurs cumulé</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartClientAcheteurCumule" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>

            </div>


            <div>
                <h4>Statistique sur le volume financier de transactions</h4>
                <legend></legend>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des volumes de transaction par pays</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartTransactionPays" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des volumes de transaction par date</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartTransactionDate" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des volumes de transaction cumulé par date</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartTransactionCumule" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des volumes de transaction par type de bien</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartTransactionTypeBien" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des volumes de transaction par montant d'achat</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartTransactionMontantAchat" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <h4>Statistiques sur le AFA</h4>
                <legend></legend>
            </div>

            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des AFA par Etats Australiens</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartAFAEtat" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des AFA par dates d'adhésion</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartAFADate" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des AFA par chiffres d'affaire</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartAFAChiffreAffaire" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Répartition des AFA cumulé par dates d'adhésion</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartAFACumule" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div>
                <h4>Statistiques sur le APL</h4>
                <legend></legend>
            </div>

            <div class="row-fluid">
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par pays</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartAPLPays" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <!-- // column -->
                <div class="span6 widget well well-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par dates d'adhésion</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartAPLDateAdhesion" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par nombre de biens vendus</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartAPLNombreBienVendus" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Repartition des APL par chiffre d'affaires</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de début">
                          <input id="fieldRregular" class="span5" type="text" name="regular" placeholder="Date de fin">
                          <button class="btn btn-primary">Voir la graphe</button>
                            <div id="chartAPLChiffreAffaire" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row-fluid">
                <div class="span6 widget widget-simple">
                    <div class="widget-header">
                        <h4><i class="fontello-icon-chart"></i>Répartition des APL cumulé par dates d'adhésion</h4>
                    </div>
                    <div class="widget-content">
                        <div class="widget-body">
                            <div id="chartAPLCumule" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>
</div>
@endsection