<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div id="success-message"></div>
  <div id="error-message"></div>

  <div id="main">

    <div id="header">
      <h1>PHP & Ajax CRUD</h1>
      <div id="search-bar">
        <label>Search :</label>
        <input type="text" id="search" autocomplete="off">
      </div>
    </div>

    <div id="table-form">

      <div>
        <form id="addForm">
          First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Last Name : <input type="text" id="lname"><br>
          Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="email">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button id="save-button">Submit</button>
        </form>
      </div>
    </div>

    <table border="1" width="100%" class="table_css" cellspacing="0" cellpadding="10px">
      <thead>
        <th width="60px">Id</th>
        <th>Name</th>
        <th>Email</th>
        <th width="90px">Edit</th>
        <th width="90px">Delete</th>
      </thead>
      <tbody id="table-data">
      </tbody>
    </table>


    <div id="modal">
      <div id="modal-form">
        <h2>Edit Form</h2>
        <table cellpadding="10px" width="100%">
          <tr>
            <td>First Name:</td>
            <td><input type="text" id="edit-fname"></td>
          </tr>
          <tr>
            <td>Last Name:</td>
            <td><input type="text" id="edit-lname"></td>
          </tr>
          <tr>
            <td>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="text" id="edit-email"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" id="edit-submit" value="Update"></td>
          </tr>
        </table>
        <div id="close-btn">X</div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Load Table Records
      function loadTable() {
        $.ajax({
          url: "ajax-load.php",
          type: "POST",
          success: function(data) {
            $("#table-data").html(data);
          }
        });
      }
      loadTable(); // Load Table Records on Page Load

      // Insert New Records
      $("#save-button").on("click", function(e) {
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();

        if (fname == "" || lname == "" || email == "") {
          $('#error-message').html('All fields are required').slideDown();
          $('#success-message').slideUp();
        } else {
          $.ajax({
            url: "ajax-insert.php",
            type: "POST",
            data: {
              first_name: fname,
              last_name: lname,
              student_email: email
            },
            success: function(data) {
              if (data == true) {

                loadTable();
                $('#addForm').trigger('reset');
                $('#success-message').html('Data Successfully inserted').slideDown();
                $('#error-message').slideUp();
              } else {
                alert("");
                $('#error-message').html('Some Error Occurred').slideDown();
                $('#success-message').slideUp();
              }
            }
          })
        }

      });


      //Delete Records
      $(document).on('click', '.delete-btn', function() {
        if (confirm("Do You really want to delete this reacord? ")) {
          var studentId = $(this).data("id");
          var element = this;
          $.ajax({
            url: "ajax-delete.php",
            type: "POST",
            data: {
              id: studentId
            },
            success: function(data) {
              if (data == 1) {
                $(element).closest("tr").fadeOut();
                loadTable();
                $('#success-message').html('Data Successfully Deleted ').slideDown();
                $('#error-message').slideUp();
              } else {
                $('#error-message').html('Con\'t delete record ').slideDown();
                $('#success-message').slideUp();
              }
            }
          });
        }
      });

      //Show Modal Box
      $(document).on("click", ".edit-btn", function() {
        $(modal).show();
        var studentId = $(".edit-btn").data("id");
        // $.ajax({
        //   url: "load-update-form.php",
        //   type: "POST",
        //   data: {
        //     id: studentId
        //   },
        //   success: function(data) {
        //     $("#modal-form").html(data);
        //   }
        // });

        $("#close-btn").click(function() {
          $(modal).hide();
        });
      });

      //Hide Modal Box


      //Save Update Form
      $(document).on("click", ".edit-btn", function() {



      });

      // Live Search

    });
  </script>
</body>





</html>