<?php 
    include_once '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'header.php';
?>
<body>
  
    <div class="container">

        <br>
        
        <br>
        <br>
        <h1>All Addresses</h1>
        <br>
        <?php
            \Libs\Flash::show();
        ?>
        
        <br>
        <h1>Test Task</h1>
        <a style="float:right" href="<?php echo \Libs\Helper::link('main/create'); ?>" class="btn btn-primary">Add Address</a>
        <div style="float:none;clear:both"></div>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>First name</th>
                <th>Street</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php

                    for($z = 0 ; $z < count($var['addresses']) ; $z++){
                        echo '<tr>

                        <td>'.($z+1).'</td>
                        <td>'.$var['addresses'][$z]['first_name'].'</td>
                        <td>'.$var['addresses'][$z]['street'].'</td>
                        <td><a href="'.\Libs\Helper::link('main/edit/'.$var['addresses'][$z]['id']).'" class="btn btn-warning">Edit</a></td>
                        <td><a href="'.\Libs\Helper::link('main/delete/'.$var['addresses'][$z]['id']).'" class="btn btn-danger">Delete</a></td>

                        </tr>';
                    }

                ?>

                
                
            </tbody>
        </table>

    </div>

  
</body>
</html>