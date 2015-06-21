class apache2::params {

    $ensure_service = 'running'
    $ensure_site    = 'present'

    case $osfamily {
        'debian': {
            $sname     = 'apache2'
            $etc_path  = "/etc/$sname"
            $osconf    = 'deb'
        }
        default: {
            $sname     = 'apache2'
            $etc_path  = "/etc/$sname"
            $osconf    = 'deb'
        }
    }

    $apache2_sites = "$etc_path/sites"
    $apache2_mods  = "$etc_path/mods"

}
