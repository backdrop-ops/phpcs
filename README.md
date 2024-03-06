# Backdrop Coding Standards

See the [official documentation](https://docs.backdropcms.org/php-standards)
 for Backdrop PHP coding standards.

## Installation

Work in progress, see https://github.com/backdrop/backdrop-issues/issues/5245

For now you can simply download the zip file or clone it locally. Put it
somewhere *outside* your Backdrop install.

## Usage

There are several ways to install the `phpcs` commandline tool in your dev
environment.
Some Linux distributions provide a package (e.g. Debian php-codesniffer).
Make sure, the version is at least 3.5.
If you want to run it on PHP 8.1, it has to be at least 3.7.1.

But you can also download phpcs [from Github](https://github.com/PHPCSStandards/PHP_CodeSniffer/releases)
 and put it in your $PATH.

With the "standard" parameter you can now tell phpcs, where the standard is
located. Point it to the directory that contains the ruleset.xml file.

Example usage to run checks in the current directory.

```
phpcs --standard=/path/to/phpcs/Backdrop .
```
See full phpcs documentation in their Wiki:
https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki

Or run `phpcs --help` for a short overview.

## Issues

Bugs and feature requests should be reported in the
 [Issue Queue](https://github.com/backdrop-ops/phpcs/issues).

## Maintainers

- [Indigoxela](https://github.com/indigoxela)
- [Peter Anderson](https://github.com/BWPanda)
- Additional maintainers welcome!

## Credits

Created for Backdrop by Indigoxela.

[PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer) is a project
formerly maintained by Squiz Labs, now by the PHPCSStandards organization.
It's licensed under BSD-3-Clause.

Several sniffs for the Backdrop ruleset have been forked from
[Drupal Coder](https://github.com/pfrenssen/coder), which is licensed under
 GPL-2.0-or-later.

## License

This project is GPL v2 software. See the LICENSE.txt file in this directory for complete text.
