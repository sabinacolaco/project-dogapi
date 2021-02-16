<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dog Breeds</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
        <style>
        .hiddenRow {padding: 0 !important;}        
        img{width:100%;}
        .margin40{margin-bottom: 40px;}
        </style>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center">Dog Breeds</h2>
            <h6 class="text-center">Listed all the dog breeds using the <a href="https://dog.ceo" target="_blank">dog ceo</a> API.</h6>
            <?php
            include('src/Request.php');
            $dogbreed = new Request();
            $result = $dogbreed->allBreeds();
            ?>
            <table class="table table-bordered display" id="example">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Breed</th>
                        <th>View Image</th>
                        <th>Sub-breed</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    foreach($result['message'] as $breed => $subbreed) {
                        $showsubbreed = '';
                        $arrow = "";
                        if(count($subbreed)>0) {
                            $arrow = "&nbsp;&nbsp;<i class='glyphicon glyphicon-plus' data-toggle='collapse' data-target='#demo".$i."' class='accordion-toggle'></i>"; 
                            $showsubbreed .= '<table class="accordian-body collapse" id="demo'.$i.'" style="width:100%;">';
                            foreach($subbreed as $s) {
                                $showsubbreed .= '<tr>
                                                    <td class="hiddenRow">'.$s.'</td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td><a href="#checkImage" data-toggle="modal" data-img="'.$breed.'"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                                  </tr>';
                            }
                            $showsubbreed .= '</table>';

                        }
                        echo '<tr ><td>'.$i.'</td>';
                        echo "<td>".$breed."</td>";
                        echo "<td><a href='#checkImage' data-toggle='modal' data-img='".$breed."'><span class='glyphicon glyphicon-eye-open'></span></a></td>";
                        echo "</td><td>".$arrow."<br>".$showsubbreed."</td></tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <div class="row text-center margin40">
                <a href="#checkImage" class="btn btn-lg btn-success" data-toggle="modal" data-img="random">Click here for random dog image</a>
            </div>
            <div class="modal fade" id="checkImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" style="color:black;" id="myModalLabel">View Image</h4>
                        </div>
                        <div class="modal-body" style="color:black;"><img src="images/giphy.gif" alt="dog" id="dog-image" width="256" height="256"></div>
                            <div class="modal-footer">
                            <button type='submit' data-dismiss="modal" name='submit' class='btn btn-success'>Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
            $('#checkImage').on('shown.bs.modal', function (e) {
                var img1 = $(e.relatedTarget).data('img');     
                $.ajax({
                    type: "POST",
                    data: {
                      'data-img': img1
                    },
                    url: "src/ajaxcallimage.php",
                    success: function(msg)
                    {
                      if(msg)
                        $("#dog-image").attr("src", msg);
                      else
                        $("#dog-image").attr("src", 'images/no_preview_available.png');
                    }
                });
            });    
            $('#checkImage').on('hidden.bs.modal', function (e) {
                $("#dog-image").attr("src", "images/giphy.gif");
            });
        });
        </script>
    </body>
</html>
