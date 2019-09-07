INSERT INTO `permissions` (`name`, `display_name`, `description`, `created_at`, `updated_at`, `routes`)

VALUES

('users', 'show users', 'users', NULL, NULL, 'users.index'),
('users_edit', 'edit users', 'edit users', NULL, NULL, 'users.update,users.edit'),
('users_delete', 'Delete users', 'Delete users', NULL, NULL, 'users.destroy'),
('users_add', 'ADD User', 'ADD users', NULL, NULL, 'users.create,users.store'),
('users_show', 'Show users', 'Show users', NULL, NULL, 'users.show');