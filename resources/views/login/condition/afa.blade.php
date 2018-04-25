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
<!-- content -->
<div id="property-single"> 
    <div class="main-slider-wrapper clearfix content corps"> 
        <div id="slider"> 
            <div class="container text-center"> 
                <div class="jumbotron"> 
                        <h2>Australian Francophone Agents</h2> 
                </div>                     
            </div>                 
        </div>             
    </div>

   <!-- Modal Bootstrap   -->
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Explanation message</h4>
          </div>
          <div class="modal-body">
            <p>
                The Australian Francophone Agents are Australian agents who are partners with "Investir en Australie" website.
                They are the essential link in the material realization of the sale of the products posted on the site, but
                they can also sell their own products.The Australian Francophone Agent must make the commitment to provide
                prospective or actual purchasers with a service in French during preliminary sales and during sales
                transactions. They must also accept that a clientele introductory fee
                ("Commission de Présentation de Clientèle" - CPC) will be due to the company managing IEA website in case of
                actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the
                commitment to verify and guarantee that the products for the sale of which they are the operating agent are
                effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners
                in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review
                Board (FIRB).
            </p>
          </div>
          <div class="modal-footer">
           <a type="button" class="pull-left btn btn-default" href="javascript:history.back()">Abandon</a>
           <a type="button" class="btn btn-default" href="#section1" id="custom-close">Continue</a>
          </div>
        </div>

      </div>
    </div>
    <!-- End Bootstrap Modal -->

    <div class="container" id="section1"> 
        <div class="row">
            <div class="col-md-12"> 

                <!-- breadcrumbs -->
                <div class="container"> 
                    <div class="row">
                            <div class="col-md-12"> 
                                <div id="content">   
                                    <div role="main">
                                        <div id="breadcrumbs" class="group font-size-14"><div class="breadcrumb"><a href="{{route('home')}}">Home</a> <span class="aquo">&gt;</span> Australian Francophone Agents </div></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <h4 class="title wow slideInLeft" style="visibility: hidden; animation-name: none;">
                        Australian Francophone Agent acceptation page</h4> 
                </div>

                <section class="at-faq-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                            <form action="" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 1 – Francophone service
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian francophone Agent commits to providing a service in french to
                                                prospectice or actual purchasers. <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition1" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 2 – Clientele Introductory Fee
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian Francophone Agent accepts that a clientele introductory fee
                                                ("Commission de Présentation de Clientèle" - CPC) will be due to the company
                                                managing IEA website in case of actual sale of products. Therefore they
                                                commit to have the buyer pay that fee at the same time they sign the sale
                                                contract, and to pay it back to IEA website managing company without delay .
                                                <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition2" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 3 – Terms and Conditions of Use
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian Francophone Agent acknowledges having read the Terms and Conditions of Use of the
                                                site "Investir en Australie" and declares to accept them without any reservation. <br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition3" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STEP 4 - Legal compliance of products
                                            </h4>
                                        </div>
                                            <div class="panel-body">
                                                The Australian francophone Agent makes the commitment to verify and guarantee that the products
                                                for the sale of which they are the operating agent are effectively residential, land, industrial
                                                or commercial properties which may be sold to non-resident foreigners in accordance with the
                                                Australian law and the rules applicable to foreign investment by the Foreign Investment
                                                Review Board (FIRB).<br>
                                                <label data-pg-collapsed> 
                                                    <input class="control-label" type="checkbox" name="condition[]" id="condition4" value="1" >   &nbsp;     I agree *
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                 <p class="help-block">
                                        <em>(*) Required field</em>
                                 </p>
                                <a class="pull-left btn btn-danger btn-lg text-center" href="/">Abandon</a>
                                 <button  type="submit" class="pull-right btn btn-danger btn-lg text-center">Continue</button>
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
