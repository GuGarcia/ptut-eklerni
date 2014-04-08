PTUT : Eklerni
========================
  
Commands :  
composer install  
php app/console doctrine:database:create  
php app/console doctrine:schema:update --force  
php app/console doctrine:fixtures:load --append  


php app/console translation:extract fr --bundle="EklerniBackBundle" --output-format=xlf  
php app/console translation:extract en --bundle="EklerniBackBundle" --output-format=xlf  
php app/console translation:extract fr --bundle="EklerniCASBundle" --output-format=xlf  
php app/console translation:extract en --bundle="EklerniCASBundle" --output-format=xlf  
php app/console translation:extract fr --bundle="EklerniDatabaseBundle" --output-format=xlf  
php app/console translation:extract en --bundle="EklerniDatabaseBundle" --output-format=xlf  
php app/console translation:extract fr --bundle="EklerniFrontBundle" --output-format=xlf  
php app/console translation:extract en --bundle="EklerniFrontBundle" --output-format=xlf  
