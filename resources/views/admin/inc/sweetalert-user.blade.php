<!-- SweetAlert -->
<script src="{{asset('lte/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>
  $(function () {
      
      $('.btn-delete').click(function(e){
        e.preventDefault();
        var $this = $(this);
        swal({
          title: "@lang('alert.are_you_sure')",
          text: "@lang('alert.delete_content')",
          icon: "warning",
          buttons: ["@lang('app.btn.cancel')", "@lang('app.btn.delete')"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              ajax($this);
          }
        });
      })
      
      $('.btn-status').click(function(e){
        e.preventDefault();
        var $this = $(this);
          
        var action = $this.attr('data-action');
        var text = '';
        var txtBtn = true;
          
        if(action == 'disable'){
            text = "@lang('alert.disable_content')";
            txtBtn = "@lang('app.btn.disable')";
        }else{
            text = "@lang('alert.active_content')";
            txtBtn = "@lang('app.btn.active')";
        }
          
        swal({
          title: "@lang('alert.are_you_sure')",
          text: text,
          icon: "warning",
          buttons: ["@lang('app.btn.cancel')", txtBtn],
        })
        .then((willDelete) => {
          if (willDelete) { 
              ajax($this);
          }
        });
      })
      
      function ajax($this, url, id, action){
        var id = $this.attr('data-id');
        var url = $this.attr('data-href');
        var action = $this.attr('data-action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {data_id: id, action: action},
            beforeSend: function( xhr ) {
                $('.preloader').fadeIn();
            }
        }).done(function(data){
            $('.preloader').fadeOut();
            if(data.status==1){
                swal(data.message, {
                  icon: "success",
                });
                
                if(action=='delete'){
                    $('.data-item-'+id).remove();
                }else if(action=='disable'){
                    $this.attr('data-action', 'active');
                    $this.html("@lang('app.btn.active')");
                    $('.data-item-status-'+id).html('<span class="label label-warning">désactivé</span>');
                }else if(action=='active'){
                    $this.attr('data-action', 'disable');
                    $this.html("@lang('app.btn.disable')");
                    $('.data-item-status-'+id).html('<span class="label label-success">activé</span>');
                }
            }else{
                swal(data.message, {
                  icon: "error",
                  dangerMode: true,
                });
            }
        }).fail(function(error) {
            $('.preloader').fadeOut();
            swal("@lang('alert.error')",{ icon: "error", dangerMode: true, });
        });
      }
  })
</script>