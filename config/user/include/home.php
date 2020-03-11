<?php
$url_values = $db->get_result("SELECT * FROM `url_controller`");
//print_r($value);
?>
<div class="container">
  <div class="d-flex justify-content-center">
    <h2>Home Page</h2>
  </div>
  <br>
  
  <div class="d-flex justify-content-left ">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add New Url</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <form action="" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Url</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">URL</label>
                  <input type="text" name="url_route" id="" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="">File Path</label>
                  <input type="text" name="file_path" id="" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" name="title" id="" class="form-control" placeholder="" >
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea  class="form-control" name="description" id=""></textarea>
                </div>
                <div class="form-group">
                    <label for="">URL Status</label>
                    <select  class="form-control" name="status" id="">
                      <option value="publish">Publish</option>
                      <option value="unpublished">Unpublished</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Request Type</label>
                    <select  class="form-control" name="request_type" id="">
                        <option value="get,post">GET , POST</option>
                      <option value="get">GET</option>
                      <option value="post">POST</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="form_type" value="add_new_url">
                <input name="form_type_requested_url"  type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <button type="submit" class="btn btn-primary">Add New</button>
            </div>
        </div>
    </form>
  </div>
</div>


    
    
    
    <a href="">
        <button class="btn btn btn-primary mx-2" > Reload Page </button>
    </a>
    
   
  </div>
  <br>
  <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                
                <th>ID</th>
                <th>Unique Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>URL</th>
                <th>Loaded File</th>
                <th>Status</th>
                <th>Edit File</th>
                <th>Delete</th>
                <th>Start date</th>
              
                <th></th>
            </tr>
        </thead>
        <tbody>

        <?php foreach($url_values as $val) : ?>
            <tr>
               
                <td><?php echo $val['ID'] ?></td>
                <td><?php echo $val['U_ID'] ?></td>
                <td><?php echo $val['title'] ?></td>
                <td><?php echo $val['description'] ?></td>
                <td><?php echo $val['url'] ?></td>
                <td><?php echo $val['path_view'] ?></td>
                <td><?php echo $val['status'] ?></td>
                <td>
                    <?php 
                    $filename = '../../views/'.$val['path_view'];
                    //echo $filename;
                    if (file_exists($filename)) {
                        ?>
                        <a href="?url=file_edit&id=<?php echo $val['ID'] ?>&path_val=<?php echo 'views/'.$val['path_view'] ?>" target="_blank">
                            <button type="button" class="btn btn-primary "> Edit file </button>
                        </a>
                        <?php
                    } else {
                        echo "The file ".$val['path_view']." does not exist";
                    }
 ?>
                   
                </td>
                <td>
                    <form action="" method="post">
                    <input type="hidden" name="url_deleted_id" value="<?php echo $val['ID'] ?>">
                    <input type="hidden" name="form_type" value="delete_url">
                    <input name="form_type_requested_url"  type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                   
                </td>
                <td> <?php echo $val['created_at'] ?> </td>
                <td></td>
            </tr>
        <?php endforeach;?>  
        </tbody>
        <tfoot>
            <tr>
            
                <th>ID</th>
                <th>Unique Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>URL</th>
                <th>Loaded File</th>
                <th>Status</th>
                <th>Edit File</th>
                <th>Delete</th>
                <th>Start date</th>
                <th></th>
            </tr>
        </tfoot>
    </table>


</div>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ],
    });
} );
</script>