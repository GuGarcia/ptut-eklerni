PTUT : Eklerni
========================
  
Commands :  
composer install  
php app/console doctrine:database:create  
php app/console doctrine:schema:update --force  
php app/console doctrine:fixtures:load --append  


php app/console translation:extract fr --config=back --output-format=xlf  
php app/console translation:extract en --config=back --output-format=xlf  
php app/console translation:extract fr --config=cas --output-format=xlf  
php app/console translation:extract en --config=cas --output-format=xlf  
php app/console translation:extract fr --config=front --output-format=xlf  
php app/console translation:extract en --config=front --output-format=xlf  
