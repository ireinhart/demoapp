class apache2::install inherits apache2::params {

    # Installation des Apache2/httpd
    package { $apache2::params::sname:
        ensure => installed,
    }

    include 'apache2::config'
    include 'apache2::service'

}
