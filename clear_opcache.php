<?php
// clear_opcache.php

if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache foi resetado com sucesso.\n";
} else {
    echo "OPcache não está ativo neste servidor.\n";
}
