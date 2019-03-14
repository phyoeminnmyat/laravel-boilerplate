<?php

Breadcrumbs::for('admin.appsetting.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('appsetting::labels.backend.appsetting.management'), route('admin.appsetting.index'));
});

Breadcrumbs::for('admin.appsetting.create', function ($trail) {
    $trail->parent('admin.appsetting.index');
    $trail->push(__('appsetting::labels.backend.appsetting.create'), route('admin.appsetting.create'));
});

Breadcrumbs::for('admin.appsetting.show', function ($trail, $id) {
    $trail->parent('admin.appsetting.index');
    $trail->push(__('appsetting::labels.backend.appsetting.show'), route('admin.appsetting.show', $id));
});

Breadcrumbs::for('admin.appsetting.edit', function ($trail, $id) {
    $trail->parent('admin.appsetting.index');
    $trail->push(__('appsetting::labels.backend.appsetting.edit'), route('admin.appsetting.edit', $id));
});
