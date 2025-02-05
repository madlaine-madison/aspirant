<?php

declare(strict_types=1);

use Lendable\ComposerLicenseChecker\LicenseConfigurationBuilder;

return (new LicenseConfigurationBuilder())
    ->addLicenses(
        'AFL-3.0',
        'APL-1.0',
        'Apache-2.0',
        'APSL-2.0',
        'Artistic-2.0',
        'AAL',
        'BSL-1.0',
        'BSD-3-Clause',
        'CATOSL-1.1',
        'CCDL-1.0',
        'CPAL-1.0',
        'CUA-OPL-1.0',
        'CeCill-2.1',
        'CPL-1.0',
        'EPL-1.0',
        'ECL-2.0',
        'EFL-2.0',
        'Entessa',
        'EUDatagrid',
        'EUPL-1.1',
        'EUPL-1.2',
        'Fair',
        'Frameworx-1.0',
        'LGPL-2.1-or-later',
        'LGPL-2.1',
        'LGPL-3.0',
        'IPL-1.0',
        'ISC',
        'LLPL-1.3c',
        'LPL-1.02',
        'MS-PL',
        'MS-RL',
        'MirOs',
        'MIT',
        'Motoso',
        'MPL-1.1',
        'Multics',
        'NASA-1.3',
        'NTP',
        'Naumen',
        'Nokia',
        'OFL-1.1',
        'OGTSL',
        'PHP-3.0',
        'PostgreSQL',
        'Python-2.0',
        'QPL-1.0',
        'RPSL-1.0',
        'RSCPL',
        'Simple-2.0',
        'SleepyCat',
        'SPL',
        'Watcom-1.0',
        'VSL-1.0',
        'W3C',
        'xnet',
        'ZPL-2.0',
        'Zlib'
    )
    ->build();