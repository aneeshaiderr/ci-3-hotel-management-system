<?php $this->load->view('partial/head'); ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <?php if($this->session->flashdata('succMsg')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('succMsg') ?>
        </div>
    <?php endif; ?>

     <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-body p-4">
                <h2 class="text-center mb-4 fw-bold text-primary">Signup</h2>

                <?= form_open('signup'); ?>

                <!-- First Name -->
                <div class="mb-3">
                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        placeholder="Enter your first name"
                        value="<?= set_value('first_name'); ?>"
                    >
                    <?= form_error('first_name', '<div class="text-danger small mt-1">', '</div>'); ?>
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        placeholder="Enter your last name"
                        value="<?= set_value('last_name'); ?>"
                    >
                    <?= form_error('last_name', '<div class="text-danger small mt-1">', '</div>'); ?>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <input
                        type="email"
                        name="user_email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="<?= set_value('user_email'); ?>"
                    >
                    <?= form_error('user_email', '<div class="text-danger small mt-1">', '</div>'); ?>
                </div>

                <!-- Contact -->
                <div class="mb-3">
                    <input
                        type="text"
                        name="contact_no"
                        class="form-control"
                        placeholder="Enter your contact number"
                        value="<?= set_value('contact_no'); ?>"
                    >
                    <?= form_error('contact_no', '<div class="text-danger small mt-1">', '</div>'); ?>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                    >
                    <?= form_error('password', '<div class="text-danger small mt-1">', '</div>'); ?>
                </div>

              <div class="d-flex">
             <button type="submit" class="btn btn-primary fw-bold w-100 text-white pe-4">
                      Signup
                  </button>
              </div>

                <?= form_close(); ?>
            </div>

            <div class="card-footer text-center bg-light py-3">
                <p class="mb-0">Already have an account?
                    <a href="<?= base_url('login'); ?>" class="text-primary fw-semibold">Login now</a>
                </p>
            </div>
        </div>
    </div>
</div>
