
<div class="container">
    
        <h3 class="text-center">Register</h3>
   
   
    <?php $form = app\core\html\Form::begin('/register','post')  ?>
    <?php echo $form->field($errors,'Name','text','name','Enter Name') ?>
    <?php echo $form->field($errors,'Email','email','email','name@email.com') ?>
    <?php echo $form->field($errors,'password','password','password','') ?>
    <?php echo $form->field($errors,'cnfPassword','password','cnfPassword','') ?>

    <input type="submit" value="submit">
    <?php echo $form::end()  ?>
  
</div>