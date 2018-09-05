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
          
        if(action == 'publish'){
            text = "@lang('alert.publish_content')";
            txtBtn = "@lang('app.btn.publish')";
        }else{
            text = "@lang('alert.archive_content')";
            txtBtn = "@lang('app.btn.archive')";
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
                }else if(action=='archive'){
                    $this.attr('data-action', 'publish');
                    $this.html("@lang('app.btn.publish')");
                    $('.data-item-status-'+id).html('<span class="label label-warning">archivé</span>');
                }else if(action=='publish'){
                    $this.attr('data-action', 'archive');
                    $this.html("@lang('app.btn.archive')");
                    $('.data-item-status-'+id).html('<span class="label label-success">publié</span>');
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