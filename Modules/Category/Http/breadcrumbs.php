<?php

Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('category::labels.backend.category.management'), route('admin.category.index'));
});

Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push(__('category::labels.backend.category.create'), route('admin.category.create'));
});

Breadcrumbs::for('admin.category.show', function ($trail, $id) {
    $trail->parent('admin.category.index');
    $trail->push(__('category::labels.backend.category.show'), route('admin.category.show', $id));
});

Breadcrumbs::for('admin.category.edit', function ($trail, $id) {
    $trail->parent('admin.category.index');
    $trail->push(__('category::labels.backend.category.edit'), route('admin.category.edit', $id));
});
