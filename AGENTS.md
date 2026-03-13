# Agent guidance – wp-module-install-checker

This file gives AI agents a quick orientation to the repo. For full detail, see the **docs/** directory.

## What this project is

- **wp-module-install-checker** – A module that checks a WordPress installation to see if it is a fresh install and to fetch the estimated installation date. Registers with the Newfold Module Loader; no runtime Composer requires. Maintained by Newfold Labs.

- **Stack:** PHP 7.3+. No runtime Composer deps.

- **Architecture:** Registers with the loader; used by onboarding-data and others. See docs/integration.md.

## Key paths

| Purpose | Location |
|---------|----------|
| Bootstrap | `bootstrap.php` |
| Includes | `includes/` |
| Tests | `tests/` |

## Essential commands

```bash
composer install
composer run test
composer run test-coverage
```

## Documentation

- **Full documentation** is in **docs/**. Start with **docs/index.md**.
- **CLAUDE.md** is a symlink to this file (AGENTS.md).

---

## Keeping documentation current

When you change code, features, or workflows, update the docs. When cutting a release, update **docs/changelog.md**.
