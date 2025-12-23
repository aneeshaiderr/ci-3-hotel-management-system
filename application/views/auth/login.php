<?php $this->load->view('/partial/head'); ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow">
      <div class="card-body p-5">
        <h2 class="text-center mb-3 fw-bold text-primary"><?php echo lang('login_heading');?></h2>
        <p class="text-center mb-4"><?php echo lang('login_subheading');?></p>

        <?php if (!empty($message)): ?>
          <div class="alert alert-info">
            <?php echo $message; ?>
          </div>
        <?php endif; ?>

        <?php echo form_open("auth/login");?>

          <div class="mb-3">
            <label for="identity" class="form-label"><?php echo lang('login_identity_label', 'identity');?></label>
            <?php echo form_input($identity, '', 'class="form-control" id="identity" placeholder="Enter email or username"'); ?>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label"><?php echo lang('login_password_label', 'password');?></label>
            <?php echo form_input($password, '', 'class="form-control" id="password" placeholder="Enter password"'); ?>
          </div>

          <div class="form-check mb-3">
            <?php echo form_checkbox('remember', '1', FALSE, 'class="form-check-input" id="remember"'); ?>
            <label class="form-check-label" for="remember"><?php echo lang('login_remember_label', 'remember');?></label>
          </div>

          <div class="d-grid">
            <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary fw-bold"'); ?>
          </div>

        <?php echo form_close();?>

        <div class="mt-3 text-center">
          <a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
        </div>
      </div>
    </div>
  </div>
</div>
