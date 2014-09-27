Instructions
============

Ensure your database is created before running these commands:

Initialize dbal tables to support document structure in PHPCR:
```bash
php vendor/bin/jackalope jackalope:init:dbal
```

This will register basic node types, namespaces, first base root node,
types of nodes, types of properties and workspace:
```bash
php vendor/bin/phpcrodm doctrine:phpcr:register-system-node-types
```
