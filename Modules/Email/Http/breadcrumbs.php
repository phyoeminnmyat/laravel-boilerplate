<?php

Breadcrumbs::for('admin.email.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('email::labels.backend.email.management'), route('admin.email.index'));
});

Breadcrumbs::for('admin.email.create', function ($trail) {
    $trail->parent('admin.email.index');
    $trail->push(__('email::labels.backend.email.create'), route('admin.email.create'));
});

Breadcrumbs::for('admin.email.show', function ($trail, $id) {
    $trail->parent('admin.email.index');
    $trail->push(__('email::labels.backend.email.show'), route('admin.email.show', $id));
});

Breadcrumbs::for('admin.email.edit', function ($trail, $id) {
    $trail->parent('admin.email.index');
    $trail->push(__('email::labels.backend.email.edit'), route('admin.email.edit', $id));
});
