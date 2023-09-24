# Simple Logger

## Assumptions

- Laravel is not being used and the code is meant to be generic. This is because the Log facade in Laravel does most of what is being done here. This also means that:
	- there is no config function so I needed to use getenv/putenv
	- No log rotate thought was put into this and only direct file append (monolog takes care of this)
	- not done in a Helper structure since it is outside of Laravel but used a pseudo-mvc structure out of habit

## Adding log targets
Change the way that the config/env works and set it as a 2-dimentional array. Each level would be an index and an array of handlers would be used for each. This would allow a level to both write to file and trigger an API notification.

## Minimum log levels per target
Add another array containing the minimum levels for each type of handler and create a method to set these receiving the handler and the minimum level.

## How to make this more extensible

Extrapolate this to a company-wide or public package so all projects could use a single source of truth
	
## Improvements

- hook different Log managers like Grafana, DataDog, Cloudwatch, etc... using handlers
- add handlers that would trigger notification APIs based on the specific log rules like "Errors with the text **database timeout**". These notifications would use services like Twilio, MailGun, Slack, etc... for emergency notifications that would bypass minimum levels.
- check to make sure that the env config is in place for the minimum log level


