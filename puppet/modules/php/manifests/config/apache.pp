class php::config::apache($document_root = '/vagrant/', $server_name = 'local.dev' ) {

  include 'apache2'

  realize(Apache2::Module['rewrite'])

  apache2::module { ['php5']:
    ensure  => present,
    require => Class[php::install],
  }

  # Setups the virtual host
  file { '/etc/apache2/sites-available/php-site.conf':
    content => template('php/site.conf.erb'),
    notify  => Service['apache2'],
    require => Class['apache2'],
  }

  apache2::site{ 'php-site.conf':
    ensure  => 'present',
    require => File['/etc/apache2/sites-available/php-site.conf']
  }
}
