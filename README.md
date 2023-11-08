# Overall

Minimum PHP version: 8.2

# Docker

If ``docker-compose`` is used, first login to the ``php`` container to run command

# Project setup

Install all composer packages with ``composer install``

# Issues

When using Rector with ``SymfonyLevelSetList::UP_TO_SYMFONY_53`` you get that changes in ``src/FormTest.php`` need to be
done concerning the parameter for ``$forms`` in two methods. \
Rector wants to change the type of the parameter from ``Traversable`` to ``iterable``.\
This is incorrect, since ``SymfonySetList::SYMFONY_53`` states that it should be ``Traversable``.\
In ``SymfonySetList::SYMFONY_50_TYPES`` is stated that the parameter should be ``iterable``, so it looks like Rector is
looking at this rule.

When using Rector with ``SymfonySetList::SYMFONY_53`` only, Rector states that all files are fine.

It looks like, when using the ``UP_TO_*`` Symfony level set lists, the order of execution of the rules is done in the
wrong way.

In the config file
of ``SymfonySetList::UP_TO_SYMFONY_53`` (``vendor/rector/rector-symfony/config/sets/symfony/level/up-to-symfony-53.php``)
the sets are defined as follows:

```
$rectorConfig->sets([SymfonySetList::SYMFONY_53, SymfonyLevelSetList::UP_TO_SYMFONY_52]);
```

If you switch the two defined sets around and run Rector again, then it states all files are fine. For this there is the
custom list ``RectorList::UP_TO_SYMFONY_53_CHANGED`` in ``src/RectorList.php``

# Testcases

``SymfonyLevelSetList::UP_TO_SYMFONY_53``:
run ``php vendor/bin/rector process --dry-run --config rector-upto53.php --clear-cache`` -> wrong results

``SymfonySetList::SYMFONY_53``:
run ``php vendor/bin/rector process --dry-run --config rector-only53.php --clear-cache`` -> correct results

``RectorList::UP_TO_SYMFONY_53_CHANGED``:
run ``php vendor/bin/rector process --dry-run --config rector-upto53-changed.php --clear-cache`` -> correct results