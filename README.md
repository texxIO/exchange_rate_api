# Exchange Rate Api
Just an exchange rate api app

1. Clone
2. Run `composer install`
3. Start the php server with `php -S localhost:8001 -t public/`
4. Do some requests:


//get a pair rate

`GET api/rate/eurusd`


//update a pair rate
```
curl -X PUT \
   http://localhost:81/api/rate/eurusd \
   -H 'Accept: */*' \
   -H 'Content-Type: application/json' \
   -H 'Host: localhost:81' \
   -d '{
 	"currency":"eurusd",
 	"rate":"2.3"
 }
``` 
 
 The tests can be run with `./bin/phpunit`

Good to know! 
This project doesnt uses a database, has an inMemory repository for tests.
I'll add it at some point.

Have fun!
