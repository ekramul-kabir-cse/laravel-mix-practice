
    <!-- Bootstrap JS and jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

   <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    

    <script>
      @if(session()->has('alert'))
      @php
          $alert = session()->get('alert');
          $alertType = $alert['type'];
          $alertMessage = $alert['message'];
      @endphp
  
      @if($alertType == 'success')
      toastr.success('{{ $alertMessage }}');
      @endif
      @if($alertType == 'warning')
      toastr.warning('{{ $alertMessage }}');
      @endif
      @if($alertType == 'error')
      toastr.error('{{ $alertMessage }}');
      @endif
  
          @endif
  
          window.onload = function () {
          clock();
  
          function clock() {
              var now = new Date();
              var TwentyFourHour = now.getHours();
              var hour = now.getHours();
              var min = now.getMinutes();
              var sec = now.getSeconds();
              var mid = 'pm';
              if (min < 10) {
                  min = "0" + min;
              }
              if (hour > 12) {
                  hour = hour - 12;
              }
              if (hour == 0) {
                  hour = 12;
              }
              if (TwentyFourHour < 12) {
                  mid = 'am';
              }
              document.getElementById('digital-clock').innerHTML = hour + ':' + min + ':' + sec + '' + mid;
              setTimeout(clock, 1000);
          }
      }
  
      $('.show_confirm').click(function (event) {
          var form = $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
              .then((willDelete) => {
                  if (willDelete) {
                      form.submit();
                  }
              });
      });
      
  
  </script>
  
    <script>
      $(document).ready(function() {
        $('#my-form').submit(function(e) {
          e.preventDefault();
          var formData = new FormData(this); // create FormData object
          $.ajax({
            url: '/store',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false, // set content type to false for FormData
            processData: false, // set processData to false for FormData
            success: function(response) {
              // handle success response here
              $('#success-message').text('Form submitted successfully!');
              $('#my-form')[0].reset(); // reset form
              setTimeout(function() {
              location.reload(); // reload page after 2 seconds
              },2000);
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // handle error response here
              $('#error-message').text('An error occurred while submitting the form.');
            }
          });
        });
      });
  </script>
  
  
  <script>
      $(document).ready(function() {
      $.ajax({
          url: "{{ route('get-users') }}",
          type: "GET",
          dataType: "json",
          success: function(response) {
              var users = response.users;
              var tbody = $('#user-table-body');
              for (var i = 0; i < users.length; i++) {
                  var user = users[i];
                  var row = '<tr>' +
                      '<td>' + user.name + '</td>' +
                      '<td>' + user.email + '</td>' +
                      '<td>' + user.phone + '</td>' +
                      '<td>' + user.address + '</td>' +
                      '<td>' + user.dob + '</td>' +
                      '<td>' +
                          (user.image ? '<img src="{{ asset('storage/images') }}/' + user.image + '" alt="' + user.name + '" style="max-width: 100px; max-height: 100px;">' : 'No image found.') +
                      '</td>' +
                  '</tr>';
                  tbody.append(row);
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }
      });
  });
  </script>

</body>

</html>