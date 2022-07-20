<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animals Table</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/animals.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="js/animals.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>     
        <style>
            td {
                font-family: Arial, Helvetica, sans-serif;
                border: 5px solid;
                text-align: center;
                font-weight: bold;
            }
            #title {
                text-align: center;
                color: darkgoldenrod;
            }
            #toggle {
                color: 	#4397fb;
            }
            #toggle:hover {
                color: #467bc7
            }
            thead input {
                width: 100%;
            }
            .thumbnailSize{
                height: 100px;
                width: 100px;
                transition:transform 0.25s ease;
            }
            .thumbnailSize:hover {
                -webkit-transform:scale(3.5);
                transform:scale(3.5);
            }
        </style>
    </head>

    <header style="background-color:white">
        <div id="secondary_screen_buttons">
            <div id="back_button">
                <a href="create_custom_word.php"><img src="images/back_icon.png" alt="Back Icon" style="Display:Block;width:70px;height:70px;"></a>
            </div>
            <div id="add_button">
                <a href="create_custom_word.php"><img src="images/add_icon.png" alt="Add Icon" style="Display:Block;width:70px;height:70px;"></a>
            </div>
        </div>
        <div id="game_title">
            <p>Custom Word List</p>
        </div>
        <div id="secondary_screen_logo">
            <a href="https://telugupuzzles.com"><img src="images/logo.png" alt="10000 Icon" style="height:80px;width:auto;"></a>
        </div>
    </header>
    <body style="background-color:#f2edf2">

<?php $page_title = 'Animals > puzzle word list';
?>

<!-- Page Content -->
<br><br>
   
    <h2 id="title">Word List</h2><br>
    
    <?php
                    $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
                    $word = $_POST['word'];
                    $email = $_POST['email'];

                    $found = False;
                    $sql = "SELECT * FROM custom_words WHERE word = '$word'";
                    $result = $conn->query($sql);
                
                    if ($result -> num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                            $found = True;
                        }
                    }//end if

                    if ($found) {
                        echo "<br><h1 style='text-align:center'>Word already exists in database.</h1><br>";
                   } else {
                        $INSERT = "INSERT INTO custom_words(word, email, total_plays, winning_plays) values(?, ?, 0, 0)";            

                        $stmt = $conn->prepare($INSERT);
                        $stmt->bind_param("ss", $word, $email);
                        if ($stmt->execute()) {
                            echo "<br><p style='text-align:center'>New record inserted sucessfully.<p><br>";
                        }
                        else {
                            
                        }
                }
                    $conn -> close(); 



    ?>
    <div id="customerTableView">
        <table class="display" id="wordTable" style="width:100%; border: 1px solid; border-collapse: collapse;">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Word</th>
                    <th>Email</th>
                    <th>Winning Plays</th>
                    <th>Total Plays</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <div>
                    <strong> Toggle column: </strong> 
                    <a id="toggle" class="toggle-vis" data-column="0">ID</a> - 
                    <a id="toggle" class="toggle-vis" data-column="1">Word</a> - 
                    <a id="toggle" class="toggle-vis" data-column="2">Email</a> - 
                    <a id="toggle" class="toggle-vis" data-column="3">Winning Plays</a> - 
                    <a id="toggle" class="toggle-vis" data-column="4">Total Plays</a> - 
                    <a id="toggle" class="toggle-vis" data-column="5">Modify</a> - 
                    <a id="toggle" class="toggle-vis" data-column="6">Delete</a> -
                </div> <br>
                
                <?php
                $conn = mysqli_connect("localhost", "root", "", "ics499_animals");
                $sql = "SELECT * FROM custom_words";
                $result = $conn->query($sql);

                // fetch the data from $_GLOBALS
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $id = $row["Id"];
                    $word = $row["word"];
                    $email = $row["Email"];
                    $winning_plays = $row["winning_plays"];
                    $total_plays = $row["total_plays"];

                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'word','<?php echo $id; ?>')"><?php echo $word; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'Email','<?php echo $id; ?>')"><?php echo $email; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'winning_plays','<?php echo $id; ?>')"><?php echo $winning_plays ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'total_plays','<?php echo $id; ?>')"><?php echo $total_plays; ?></div></span> </td>
                    <?php echo '<td><a class="btn btn-warning btn-sm" href="update_custom_word.php?id='.$row["Id"].'">Modify</a></td>' ?>
                    <?php echo '<td><a class="btn btn-danger btn-sm" href="delete_custom_word.php?rn='.$row["Id"].'">Delete</a></td>' ?>
                </tr>
                 <?php  //end while
                }//end if
            }//end second if 

  
                ?>

                </tbody>
            </div>
        </table>
    </div>
</div>

<!-- /.container -->

<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#wordTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#wordTable thead tr').clone(true).appendTo( '#wordTable thead' );
        $('#wordTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#wordTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

    $(document).ready(function() {
        
    var table = $('#wordTable').DataTable( {
        retrieve: true,
        "scrollY": "200px",
        "paging": false
    } );
 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );


function updateValue(element,column,id){
        var value = element.innerText
        $.ajax({
            url:'editable_custom_list.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
				console.log(php_result);
				
            }
            
        })
    }




</script>

</body>
</html>