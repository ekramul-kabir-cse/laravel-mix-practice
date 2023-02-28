
    <!-- Bootstrap JS and jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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