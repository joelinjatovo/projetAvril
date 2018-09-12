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
      
      $('.btn-star').click(function(e){
        e.preventDefault();
        var $this = $(this);
        ajax($this);
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
                }
                
                if(action=='star'){
                    if(data.starred==1){
                        $this.find('i').removeClass('fa-star-o')
                            .addClass('fa-star');
                    }else{
                        $this.find('i').removeClass('fa-star')
                            .addClass('fa-star-o');
                    }
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
