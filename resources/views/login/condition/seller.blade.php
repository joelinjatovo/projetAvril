@extends('layouts.app')

@section('style')
<style>
.modal {
    display: none;
    overflow: scroll;
    position: fixed;
    top: 0px;
}
</style>
@endsection

@section('content')
<div id="property-single">
    <div class="main-slider-wrapper clearfix content corps">
        <div id="main-slider">
            <div class="slide">
                <img src="http://localhost/iea/assets/images/slider/1.jpg" alt="Slide">
            </div>
            <div class="slide">
                <img src="http://localhost/iea/assets/images/slider/2.jpg" alt="Slide">
            </div>
            <div class="slide">
                <img src="http://localhost/iea/assets/images/slider/3.jpg" alt="Slide">
            </div>
            <div class="slide">
                <img src="http://localhost/iea/assets/images/slider/4.jpg" alt="Slide">
            </div>
        </div>
        <div id="slider">
            <div class="container text-center">
                <div class="jumbotron">
                        <h1>Seller</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="content">
                    <h1 class="page-title aligncenter" id="section1">Acceptance Page - Seller </h1>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Explanation message</h4>
          </div>
          <div class="modal-body">
            <p>
                The Seller must accept The Terms and Conditions of Use of "Investir en Australie" website and make the
                commitment  to display only products that can be sold to non-resident foreigners in accordance with Australian
                law and the rules applicable by the Foreign Investment Review Board (FIRB).
            </p>
          </div>
          <div class="modal-footer">
           <a type="button" class="pull-left btn btn-default" href="javascript:history.back()">Abandon</a>
           <a type="button" class="btn btn-default" href="#section1" id="custom-close">Continue</a>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="col-md-12">
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        SELLER'S AGREEMENT</h4>
                </div>
                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="post">
                                <div class="panel-group">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                STEP 1 – Terms and Conditions of Use
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Seller acknowledges having read the Terms and Conditions of Use of the site
                                                "Investir en Australie" and declares to accept them without any reservation
                                                <br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" name="condition1" value="0" id="condition1" >    I agree   *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 2 – Legal compliance of products
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Seller makes the commitment, under its sole responsibility, to display on "Investir en Australie"
                                                site only products that can be sold to non-resident foreigners in accordance with Australian law and the
                                                rules applicable by the Foreign Investment Review Board (FIRB).<br>
                                                <label data-pg-collapsed>
                                                    <input class="control-label" type="checkbox" value="0" id="condition2" name="condition2">   &nbsp;I agree   *
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                 <p class="help-block">
                                        <em>(*) Required field</em>
                                 </p>
                                <a class="pull-left btn btn-danger text-center" href="/">Annuler</a>
                                <button type="submit" class="btn btn-danger text-center pull-right">Continuer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    //fermeture du modal
    $("#custom-close").on('click', function() {
        $('#myModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
</script>
@endsection
