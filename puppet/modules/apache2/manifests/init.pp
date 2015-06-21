class apache2 inherits apache2::params {

    include 'apache2::install'
    include 'apache2::config'
    include 'apache2::service'

    Class['apache2::install'] -> Class['apache2::config'] -> Class['apache2::service']
}
