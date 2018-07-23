# Reset php.ini

Inspired by [Reset CSS](https://meyerweb.com/eric/tools/css/reset/), set
all php.ini configuration settings.

PHP configuring controls may aspects of PHP's behavior, which may result in
unexpected issues. This library standardizes the ini settings.

This configuration doesn't include values you SHOULD set based on your
system resources.

It will set ini settings that can be set at runtime and trigger a warning
for other important settings with a non-standard value.

## Installation

composer require jasny/reset-php.ini

_Automatically included, does not need to be called explicitly._

