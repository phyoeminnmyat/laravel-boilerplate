<?php

Breadcrumbs::for('admin.customer.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('customer::labels.backend.customer.management'), route('admin.customer.index'));
});

Breadcrumbs::for('admin.customer.create', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('customer::labels.backend.customer.create'), route('admin.customer.create'));
});

Breadcrumbs::for('admin.customer.show', function ($trail, $id) {
    $trail->parent('admin.customer.index');
    $trail->push(__('customer::labels.backend.customer.show'), route('admin.customer.show', $id));
});

Breadcrumbs::for('admin.customer.edit', function ($trail, $id) {
    $trail->parent('admin.customer.index');
    $trail->push(__('customer::labels.backend.customer.edit'), route('admin.customer.edit', $id));
});

Breadcrumbs::for('admin.customer.deactivated', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('customer::menus.backend.customer.deactivated'), route('admin.customer.deactivated'));
});

Breadcrumbs::for('admin.customer.deleted', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('customer::menus.backend.customer.deleted'), route('admin.customer.deleted'));
});
