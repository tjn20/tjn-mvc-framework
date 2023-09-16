<?php
/** @var $model \app\models\signup */
$appObejct=\app\core\App::$app;

if($appObejct->session->get('user'))
$appObejct->response->redirectPage('home');
$output= new \app\core\Outputs($model);
?>
<form method="post" action=" ">
<div class="row">
  <div class="col">
  <div class="mb-3">
     <label class="form-label">First Name</label>
     <input type="text"  name="firstname" value="<?php echo $output->getValue('firstname') ?>" class="form-control <?php
      echo $output->hasError('firstname')?' is-invalid':'';   
    
      ?>">
     <div class="invalid-feedback">
    <?php
          echo $output->getFirstError('firstname');   

    ?> 
    </div>
   </div>
  </div>
  <div class="col">
  <div class="mb-3">
     <label class="form-label">Last Name</label>
     <input type="text"  name="lastname" value="<?php echo $output->getValue('lastname') ?>" class="form-control <?php
      echo $output->hasError('lastname')?' is-invalid':'';   
    
      ?>">
     <div class="invalid-feedback">
     <?php
          echo $output->getFirstError('lastname');   

    ?> </div>
   </div>
  </div>
</div>
<div class="mb-3">
     <label class="form-label">Email</label>
     <input type="text"  name="email" value="<?php echo $output->getValue('email') ?>" class="form-control <?php
      echo $output->hasError('email')?' is-invalid':'';   
    
      ?>">
     <div class="invalid-feedback">
     <?php
          echo $output->getFirstError('email');   

    ?> </div>
   </div>
   <div class="mb-3">
     <label class="form-label">Password</label>
     <input type="password"  name="password" value="<?php echo $output->getValue('password') ?>" class="form-control <?php
      echo $output->hasError('password')?' is-invalid':'';   
    
      ?>">
     <div class="invalid-feedback">
     <?php
          echo $output->getFirstError('password');   

    ?> </div>
   </div>
   <div class="mb-3">
     <label class="form-label">Confirm Password</label>
     <input type="password"  name="confirmPassword" value="<?php echo $output->getValue('confirmPassword') ?>" class="form-control <?php
      echo $output->hasError('confirmPassword')?' is-invalid':'';   
    
      ?>">
     <div class="invalid-feedback">
     <?php
          echo $output->getFirstError('confirmPassword');   

    ?> </div>
   </div>
<div class="alert alert-danger" role="alert">
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>