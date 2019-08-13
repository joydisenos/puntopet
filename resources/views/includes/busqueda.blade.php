<script>
        $(document).ready(function(){
            $("#buscar").keyup(function(){
            _this = this;
           
              $.each($(".list tr"), function() {
                  if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                  $(this).hide();
                  else
                  $(this).show();
              });

              $.each($(".card-filter"), function() {
                  if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                  $(this).hide();
                  else
                  $(this).show();
              });
            });
        });
  </script>