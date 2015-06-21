class apache2::config (
    $listen_ssl_ports = hiera_array('listen_ssl_ports', [ '443' ])
) {

    # predefine needed modules
    $modules = [ 'rewrite',
                 'proxy',
                 'proxy_http',
                 'proxy_ajp',
                 'ssl',
                 'headers',
                 'proxy_connect',
               ]

    @apache2::module { $modules:
        ensure => present,
    }

    # predefine sites do disable 80/443
    $disable_sites = [ 'default',
                       'default-ssl',
                     ]

    @apache2::site { [ $disable_sites ]:
        ensure => absent
    }

    file {'/etc/apache2/ports.conf':
        ensure  => 'present',
        content => template('apache2/ports.conf.erb'),
        notify  => Service['apache2'],
        require => Class['apache2::install'],
    }

}
