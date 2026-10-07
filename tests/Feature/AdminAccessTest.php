<?php

it('redirects guests from the admin panel to the login page', function () {
    $this->get('/admin')->assertRedirect('/admin/login');
});

it('shows the admin login page', function () {
    $this->get('/admin/login')->assertOk();
});
