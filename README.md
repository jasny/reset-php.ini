# Reset php.ini

Inspired by [Reset CSS](https://meyerweb.com/eric/tools/css/reset/), set
all php.ini configuration settings.

## Installation

    composer require jasny/reset-php.ini

_Automatically included, does not need to be called explicitly._

## php.ini

PHP configuring controls may aspects of PHP's behavior, which may result in
unexpected issues. This library standardizes the ini settings.

This configuration doesn't include values you SHOULD set based on your
system resources.

It will set ini settings that can be set at runtime. These settings are
specified in the `php.ini` file of this library.

### Warnings

For important settings that can't be changed at runtime and have a
non-standard value, the library will trigger a warning. As `display_errors`
is disabled, these warning will be written to the error log.

## Stream wrappers

Stream wrappers are a often the cause of a vulnerability. To prevent any
exploits by unused stream handlers, all handler are disabled by default.

Stream handlers that are used by the application can be enabled using

    stream_wrapper_restore('scheme');

_For [PSR-7 http message interfaces](https://www.php-fig.org/psr/psr-7/)
the `php://` stream wrapper is typically required. This wrapper gives access to
various I/O streams, some like `filter` are associated with possible exploits._

**Example exploits**
* [Remote File Inclusion](https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/File%20Inclusion%20-%20Path%20Traversal)
* [File Operation Induced Unserialization via the "phar://" Stream Wrapper](https://cdn2.hubspot.net/hubfs/3853213/us-18-Thomas-It's-A-PHP-Unserialization-Vulnerability-Jim-But-Not-As-We-....pdf?)

While [OWASP encourages](https://www.owasp.org/index.php/PHP_Configuration_Cheat_Sheet)
to set `allow_url_fopen` to `off`, it's enabled by reset.ini. Disabling the
stream wrappers gives similar security with more flexibility on deciding which
ones to enable.

