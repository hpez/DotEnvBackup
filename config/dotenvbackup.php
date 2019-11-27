<?php

return [
    'backup_interval' => env('DOTENVBACKUP_INTERVAL', '* * * * *'),
    'backup_dir' => env('DOTENVBACKUP_DIR', base_path())
];
