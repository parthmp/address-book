<?php 
    include_once '.'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'header.php';
?>
<body>
  
    <div class="container">

        <br>
        <a href="<?php echo \Libs\Helper::link('main/index'); ?>" class="btn btn-primary">Back</a>
        <br>
        <br>
        <h1>Add a new address</h1>
        <br>
        <?php
            \Libs\Flash::show();
        ?>
        <form action="<?php echo \Libs\Helper::link('main/create_submit'); ?>" method="POST" id="custom-form" data-pmp novalidate>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo (\Libs\Flash::check('name') == true) ? \Libs\Flash::use('name') : ''; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name" value="<?php echo (\Libs\Flash::check('first_name') == true) ? \Libs\Flash::use('first_name') : ''; ?>" id="first_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo (\Libs\Flash::check('email') == true) ? \Libs\Flash::use('email') : ''; ?>" required>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street" value="<?php echo (\Libs\Flash::check('street') == true) ? \Libs\Flash::use('street') : ''; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip">Zip code</label>
                        <input type="number" min="10000" max="999999" value="<?php echo (\Libs\Flash::check('zip') == true) ? \Libs\Flash::use('zip') : ''; ?>" name="zip" id="zip" class="form-control" required>
                    </div>
                </div>
            </div>
            
            <br>
            <div class="form-group">
                <label for="city">City</label>
             
                <select name="city" id="city" class="form-control" required>
                    <option value="">Select</option>
                    <?php

                        $selected = '';
                        if(\Libs\Flash::check('city') == true){
                            $city_id = \Libs\Flash::use('city');
                        }

                        for($z = 0 ; $z < count($var['cities']); $z++){

                            if($city_id == $var['cities'][$z]['id']){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }

                            echo '<option '.$selected.' value="'.$var['cities'][$z]['id'].'">'.$var['cities'][$z]['city_name'].'</option>';
                        
                        }
                    ?>
                </select>
            </div>
            <br>
            <br>
            <button class="btn btn-primary">Save</button>
        </form>


    </div>

  
    <script src="<?php echo \Libs\Helper::link('assets/validator.js'); ?>"></script>

</body>
</html>