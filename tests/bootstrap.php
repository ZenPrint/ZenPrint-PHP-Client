<?php

if (!file_exists('./vendor/autoload.php')) {
    echo "\n\n";
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:

wget http://getcomposer.org/composer.phar
php composer.phar install

EOT
    );
}

include join('/', array(__DIR__, '..', 'src', 'AutoLoader.php'));
include join('/', array(__DIR__, 'unit', 'artifacts', 'RESTfulMock.php'));
include join('/', array(__DIR__, 'unit', 'artifacts', 'Globals.php'));

/**
* http://www.kammerl.de/ascii/AsciiSignature.php
* o8 font with regex 0 -> z and 8 -> P
*/
echo "
###################################################################################################
#                                                                                                 #
# zzzzzzzzzzz                         zzzzzzzzzz               zPP                 zP             #
# PP    PPP    zzzzzzzzzP zz zzzzzz    PPP    PPP zz zzzzzz    zzzz  zz zzzzzz   zPPPzz           #
#     PPP     PPPzzzzzzP   PPP   PPP   PPPzzzzPP   PPP    PPP   PPP   PPP   PPP   PPP             #
#   PPP    zz PPP          PPP   PPP   PPP         PPP          PPP   PPP   PPP   PPP             #
# zPPPzzzzPPP   PPzzzzPPP zPPPz zPPPz zPPPz       zPPPz        zPPPz zPPPz zPPPz   PPPz           #
#                                                                                                 #
# zzzzz  zzzz              zPP     zP      zzzzzzzzzzz                           zP               # 
#  PPP    PP  zz zzzzzz    zzzz  zPPPzz    PP  PPP  PP  zzzzzzzzzP  zzzzzzzzP  zPPPzz  zzzzzzzzP  # 
#  PPP    PP   PPP   PPP    PPP   PPP          PPP     PPPzzzzzzP  PPPzzzzzzz   PPP   PPPzzzzzzz  # 
#  PPP    PP   PPP   PPP    PPP   PPP          PPP     PPP                 PPP  PPP           PPP #
#   PPPzzPP   zPPPz zPPPz  zPPPz   PPPz       zPPPz      PPzzzzPPP PPzzzzzzPP    PPPz PPzzzzzzPP  #
#                                                                                                 #
###################################################################################################
";

    // Register the directory to your include files
    AutoLoader::registerDirectory('./src');
?>

